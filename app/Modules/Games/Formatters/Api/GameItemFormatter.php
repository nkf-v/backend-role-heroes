<?php declare(strict_types=1);

namespace App\Modules\Games\Formatters\Api;

use App\Models\Game;
use Nkf\General\Classes\BaseFormatter;

class GameItemFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (Game $game) : array
        {
            return [
                'id' => $game->id,
                'name' => $game->name,
                'description' => $game->description,
            ];
        });
    }
}
