<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Admin\Orchid\Screens;

use App\Modules\StructuralAttributes\Admin\Orchid\Layouts\StructuralAttributeValueTable;
use App\Modules\StructuralAttributes\Models\StructuralAttribute;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class StructuralAttributeValueList extends Screen
{
    public $name = 'Attribute values';

    protected int $attributeId;

    protected function query(StructuralAttribute $attribute) : array
    {
        $this->name = sprintf('%s values', $attribute->name);
        $this->attributeId = $attribute->id;

        return [
            'values' => $attribute
                ->values()
                ->paginate(10),
        ];
    }
    public function commandBar() : array
    {
        return [
            Link::make('Create')
                ->icon('plus')
                ->route('platform.structural_attribute_values.edit', [$this->attributeId, null]),
        ];
    }

    public function layout() : array
    {
        return [
            StructuralAttributeValueTable::class,
        ];
    }
}
