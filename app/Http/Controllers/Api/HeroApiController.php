<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Formatters\Api\FullHeroApiFormatter;
use App\Formatters\Api\LightHeroApiFormatter;
use App\Http\Requests\HeroRequest;
use App\Http\Requests\HeroUpdateRequest;
use App\Models\Game;
use App\Models\Hero;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Nkf\Laravel\Classes\Exceptions\ServerError;

class HeroApiController extends ApiController
{
    public function getByGame(int $gameId, LightHeroApiFormatter $formatter) : JsonResponse
    {
        if (Game::find($gameId) === null)
            throw new ServerError(['game_id' => ['invalid_value']]);

        $heroesQuery = $this->userProvider->getUser()->heroes()->where('game_id', $gameId);
        return $this->respondedFormatListContent($heroesQuery->get(), $formatter);
    }

    public function get(int $heroId, FullHeroApiFormatter $formatter) : JsonResponse
    {
        $hero = $this->userProvider
            ->getUser()
            ->heroes()
            ->with([
                'characteristicValues',
                'attributeValues',
                'structuralAttributeValues',
                'items',
            ])
            ->find($heroId);
        if ($hero === null)
            throw new ServerError(['hero_id' => ['invalid_value']]);

        return $this->respondedFormatContent($hero, $formatter);
    }

    public function create(HeroRequest $request, FullHeroApiFormatter $formatter) : JsonResponse
    {
        $data = $request->validated();
        $user = $this->userProvider->getUser();

        if (Game::find($data['game_id']) === null)
            throw new ServerError(['game_id' => ['invalid_value']]);

        try
        {
            DB::beginTransaction();
            $hero = new Hero();
            $hero->name = $data['name'];
            $hero->user_id = $user->id;
            $hero->game_id = $data['game_id'];
            $hero->note = $data['note'] ?? null;
            $hero->save();
            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollBack();
            throw new ServerError(['hero' => ['no_create', $e->getCode()]]);
        }

        return $this->respondedFormatContent($hero, $formatter);
    }

    public function delete(int $heroId) : JsonResponse
    {
        $hero = $this->userProvider->getUser()->heroes()->find($heroId);
        if ($hero === null)
            throw new ServerError(['hero_id' => ['invalid_value']]);

        try
        {
            DB::commit();
            $hero->delete();
            DB::beginTransaction();
        }
        catch (Exception $e)
        {
            DB::rollBack();
            throw new ServerError(['hero' => ['no_delete']]);
        }

        return $this->respondContent(['message' => 'Hero delete']);
    }

    public function updated(int $heroId, HeroUpdateRequest $request) : JsonResponse
    {
        /** @var Hero $hero */
        $hero = $this->userProvider->getUser()->heroes()->find($heroId);
        if ($hero === null)
            throw new ServerError(['hero_id' => ['invalid_value']]);

        $updateHero = $request->validated();
        try
        {
            DB::beginTransaction();
            if (($updateHero['name'] ?? null) !== null)
                $hero->name = $updateHero['name'];
            if (($updateHero['note'] ?? null) !== null)
                $hero->note = $updateHero['note'];
            $hero->save();
            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollBack();
            throw new ServerError(['hero' => 'no_update']);
        }
        return $this->respondContent(['message' => 'Hero update']);
    }
}
