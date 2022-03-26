<?php declare(strict_types=1);

namespace App\Modules\Games\Admin\Orchid\Layouts;

use App\Modules\Games\Models\Game;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class GameTable extends Table
{
    protected $target = 'games';

    /** @return TD[] */
    protected function columns() : array
    {
        return [
            TD::make('name', 'Name')
                ->render(function (Game $game) : Link
                {
                    return Link::make($game->name)->route('platform.games.edit', $game->id);
                }),
            TD::make('created_at', 'Created')->date(),
            TD::make('updated_at', 'Updated')->date(),
        ];
    }
}
