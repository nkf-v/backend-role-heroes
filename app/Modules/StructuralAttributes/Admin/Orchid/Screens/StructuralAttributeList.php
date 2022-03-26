<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Admin\Orchid\Screens;

use App\Modules\StructuralAttributes\Admin\Orchid\Layouts\StructuralAttributeTable;
use App\Modules\StructuralAttributes\Models\StructuralAttribute;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class StructuralAttributeList extends Screen
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
            StructuralAttributeTable::class,
        ];
    }
}
