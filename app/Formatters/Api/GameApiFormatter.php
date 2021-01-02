<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\Game;
use Nkf\General\Classes\BaseFormatter;

class GameApiFormatter extends BaseFormatter
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
