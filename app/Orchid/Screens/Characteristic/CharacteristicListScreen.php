<?php declare(strict_types=1);

namespace App\Orchid\Screens\Characteristic;

use App\Models\Characteristic;
use App\Orchid\Filters\Characteristic\GameFilter;
use App\Orchid\Layouts\Characteristic\CharacteristicListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CharacteristicListScreen extends Screen
{
    public $name = 'Characteristics';

    public function query() : array
    {
        return [
            'characteristics' => Characteristic::paginate(10),
        ];
    }

    public function commandBar() : array
    {
        return [
            Link::make('Create')
                ->icon('plus')
                ->route('platform.characteristics.edit'),
        ];
    }

    public function layout() : array
    {
        return [
            CharacteristicListLayout::class,
        ];
    }
}
