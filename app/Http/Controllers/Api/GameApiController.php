<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Formatters\Api\GameApiFormatter;
use App\Models\Game;
use Illuminate\Http\JsonResponse;

class GameApiController extends ApiController
{
    public function getList(GameApiFormatter $formatter) : JsonResponse
    {
        return $this->respondedFormatListContent(Game::get(), $formatter);
    }
}
