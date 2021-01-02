<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Formatters\Api\FullHeroApiFormatter;
use App\Formatters\Api\LightHeroApiFormatter;
use App\Models\Game;
use App\Models\Hero;
use App\Providers\UserProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    public function getUserHeroesByGame(int $gameId, LightHeroApiFormatter $formatter) : JsonResponse
    {
        $user = $this->userProvider->getUser();
        if (Game::find($gameId) === null)
            throw new ServerError(['game_id' => ['invalid_value']]);

        $heroes = Hero::query()
            ->whereUserId($user->id)
            ->whereGameId($gameId);
        return $this->respondedFormatListContent($heroes->get(), $formatter);
    }

    public function getDetailHero(int $heroId, FullHeroApiFormatter $formatter) : JsonResponse
    {
        $hero = Hero::find($heroId);
        if ($hero === null)
            throw new ServerError(['hero_id' => ['invalid_value']]);

        $user = $this->userProvider->getUser();
        if ($hero->user_id !== $user->id)
            throw new ServerError(['hero' => ['not_found']]);

        return $this->respondedFormatContent($hero, $formatter);
    }
}
