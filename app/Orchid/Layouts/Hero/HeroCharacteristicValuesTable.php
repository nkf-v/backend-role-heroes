<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Hero;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class HeroCharacteristicValuesTable extends Table
{
    protected $target = 'hero.characteristicValues';

    protected function columns() : array
    {
        return [
            TD::make('name', 'Name'),
            TD::make('pivot.value', 'Value'),
            // TODO button with desc or name make as link
        ];
    }
}
