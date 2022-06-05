<?php declare(strict_types=1);

namespace App\Modules\Games\Controllers\Api;

use App\Modules\Games\Formatters\Api\GameItemFormatter;
use App\Http\Controllers\Api\ApiController;
use App\Modules\Games\Models\Game;
use Illuminate\Http\JsonResponse;

class GameController extends ApiController
{
    /**
     * @OA\Get (
     *     tags = {"Games"},
     *     path = "/games",
     *     summary = "Get all games",
     *     operationId = "getGames",
     *     security = {"Bearer JWT"},
     *     @OA\Response (
     *         response = "200",
     *         description = "All games"
     *     )
     * )
     */
    public function getList(GameItemFormatter $formatter) : JsonResponse
    {
        return $this->respondedFormatListContent(Game::get(), $formatter);
    }
}
