<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Characteristic;

use App\Models\Characteristic;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CharacteristicListLayout extends Table
{
    protected $target = 'characteristics';

    protected function columns() : array
    {
        return [
            TD::make('name')
                ->render(function (Characteristic $characteristic) : Link
                {
                    return Link::make($characteristic->name)
                        ->route('platform.characteristics.edit', $characteristic);
                }),
            TD::make('game')
                ->render(function (Characteristic $characteristic) : Link
                {
                    return Link::make($characteristic->game->name)
                        ->set('target', '_blank')
                        ->route('platform.games.edit', $characteristic->game);
                }),
            TD::make('created_at', 'Created')->date(),
            TD::make('updated_at', 'Updated')->date(),
        ];
    }
}
