<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Admin\Orchid\Layouts;

use App\Modules\StructuralAttributes\Models\StructuralAttributeValue;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StructuralAttributeValueTable extends Table
{
    protected $target = 'values';

    protected function columns() : array
    {
        return [
            TD::make('name', 'Name')
                ->render(function (StructuralAttributeValue $value) : Link
                {
                    return Link::make($value->name)->route('platform.structural_attribute_values.edit', ['attribute' => $value->attribute_id, 'value' => $value->id]);
                }),
        ];
    }
}
