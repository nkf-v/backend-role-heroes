<?php declare(strict_types=1);

namespace App\Orchid\Screens\StructuralAttribute;

use App\Models\StructuralAttribute;
use App\Orchid\Layouts\StructuralAttribute\StructuralAttributeListTable;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class StructuralAttributeListScreen extends Screen
{
    public $name = 'Structural attribute';

    public function query() : array
    {
        return [
            'attributes' => StructuralAttribute::paginate(10),
        ];
    }

    public function commandBar() : array
    {
        return [
            Link::make('Create')
                ->icon('plus')
                ->route('platform.structural_attributes.edit'),
        ];
    }

    public function layout() : array
    {
        return [
            StructuralAttributeListTable::class,
        ];
    }
}
