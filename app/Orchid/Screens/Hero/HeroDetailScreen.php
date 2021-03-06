<?php declare(strict_types=1);

namespace App\Orchid\Screens\Hero;

use App\Models\Hero;
use App\Orchid\Layouts\Hero\HeroAttributeValuesTable;
use App\Orchid\Layouts\Hero\HeroCharacteristicValuesTable;
use App\Orchid\Layouts\Hero\HeroDetailLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class HeroDetailScreen extends Screen
{
    public $name = 'Hero';

    public function query(Hero $hero) : array
    {
        $this->name = $hero->name;

        return [
            'hero' => $hero,
        ];
    }

    public function commandBar() : array
    {
        return [];
    }

    public function layout() : array
    {
        return [
            HeroDetailLayout::class,
            HeroCharacteristicValuesTable::class,
            HeroAttributeValuesTable::class,
        ];
    }
}
