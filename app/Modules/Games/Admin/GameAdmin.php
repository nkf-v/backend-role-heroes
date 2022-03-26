<?php

namespace App\Modules\Games\Admin;

use App\Admin\OrchidAdmin;
use App\Modules\Games\Admin\Orchid\Screens\GameEdit;
use App\Modules\Games\Admin\Orchid\Screens\GameList;
use App\Modules\Games\Models\Game;

class GameAdmin extends OrchidAdmin
{
    protected string $mainRoute = 'games';
    protected string $mainRouteItem = 'game';
    protected string $listScreen = GameList::class;
    protected string $editScreen = GameEdit::class;

    protected string $model = Game::class;
}
