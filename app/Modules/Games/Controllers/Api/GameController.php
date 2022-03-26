<?php declare(strict_types=1);

namespace App\Modules\Games\Controllers\Api;

use App\Modules\Games\Formatters\Api\GameItemFormatter;
use App\Http\Controllers\Api\ApiController;
use App\Models\Game;
use Illuminate\Http\JsonResponse;

class GameController extends ApiController
{
    public function getList(GameItemFormatter $formatter) : JsonResponse
    {
        return $this->respondedFormatListContent(Game::get(), $formatter);
    }
}
