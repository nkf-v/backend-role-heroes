<?php declare(strict_types=1);

namespace App\Orchid\Screens\Hero;

use App\Models\Hero;
use App\Orchid\Layouts\Hero\HeroAttributeValuesTable;
use App\Orchid\Layouts\Hero\HeroCharacteristicValuesTable;
use App\Orchid\Layouts\Hero\HeroDetailLayout;
use App\Orchid\Layouts\Hero\HeroStructuralAttributeValuesRows;
use Illuminate\Database\Eloquent\Collection;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class HeroDetailScreen extends Screen
{
    public $name = 'Hero';
    protected array $mapAttributeToValues = [];

    public function query(Hero $hero) : array
    {
        $this->name = $hero->name;

        foreach ($hero->structuralAttributeValues as $value)
            $this->mapAttributeToValues[$value->attribute_id][] = $value;

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
            // TODO view attributes by category
            HeroAttributeValuesTable::class,
            new HeroStructuralAttributeValuesRows($this->mapAttributeToValues),
        ];
    }
}
