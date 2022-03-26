<?php declare(strict_types=1);

namespace App\Modules\Games\Admin\Orchid\Screens;

use App\Modules\Games\Models\Game;
use App\Modules\Games\Admin\Orchid\Layouts\GameTable as GameListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class GameList extends Screen
{
    public $name = 'Games';
    public $description = 'Games list';

    public function query() : array
    {
        return [
            'games' => Game::get(),
        ];
    }

    public function commandBar() : array
    {
        return [
            Link::make('Create')
                ->icon('plus')
                ->route('platform.games.edit'),
        ];
    }

    /**
     * @return Layout[]
     */
    public function layout() : array
    {
        return [
            GameListLayout::class
        ];
    }
}
