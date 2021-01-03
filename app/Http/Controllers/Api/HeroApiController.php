<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Formatters\Api\FullHeroApiFormatter;
use App\Formatters\Api\LightHeroApiFormatter;
use App\Http\Requests\HeroRequest;
use App\Models\Game;
use App\Models\Hero;
use App\Providers\UserProvider;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Nkf\Laravel\Classes\Exceptions\ServerError;
use Nkf\Laravel\Traits\ApiController;

class HeroApiController extends Controller
{
    use ApiController;

    protected $userProvider;

    public function __construct(UserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function getHeroesByGame(int $gameId, LightHeroApiFormatter $formatter) : JsonResponse
    {
        $user = $this->userProvider->getUser();
        if (Game::find($gameId) === null)
            throw new ServerError(['game_id' => ['invalid_value']]);

        $heroes = Hero::query()
            ->whereUserId($user->id)
            ->whereGameId($gameId);
        return $this->respondedFormatListContent($heroes->get(), $formatter);
    }

    public function getHero(int $heroId, FullHeroApiFormatter $formatter) : JsonResponse
    {
        $hero = Hero::find($heroId);
        if ($hero === null)
            throw new ServerError(['hero_id' => ['invalid_value']]);

        $user = $this->userProvider->getUser();
        if ($hero->user_id !== $user->id)
            throw new ServerError(['hero' => ['not_found']]);

        return $this->respondedFormatContent($hero, $formatter);
    }

    public function createHero(HeroRequest $request, FullHeroApiFormatter $formatter) : JsonResponse
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

    public function deleteHero(int $heroId) : JsonResponse
    {
        $user = $this->userProvider->getUser();
        $hero = Hero::whereUserId($user->id)->find($heroId);
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
}
