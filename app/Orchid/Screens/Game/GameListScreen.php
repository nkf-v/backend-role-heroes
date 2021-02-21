<?php declare(strict_types=1);

namespace App\Orchid\Screens\Game;

use App\Models\Game;
use App\Orchid\Layouts\Game\GameListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class GameListScreen extends Screen
{
    public $name = 'Games';
    public $description = 'Game list';

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
