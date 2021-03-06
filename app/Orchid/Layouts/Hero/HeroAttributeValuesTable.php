<?php declare(strict_types=1);

namespace App\Orchid\Layouts\Hero;

use App\Enums\AttributeTypeEnum;
use App\Models\AttributeValue;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class HeroAttributeValuesTable extends Table
{
    protected $target = 'hero.attributeValues';

    protected function columns() : array
    {
        return [
            TD::make('attribute.name', 'Name'),
            TD::make('attribute.type_value', 'Type value')
                ->render(function (AttributeValue $attributeValue) : string
                {
                    return AttributeTypeEnum::getLabelValue($attributeValue->attribute->type_value);
                }),
            TD::make('value', 'Value'),
            // TODO button with desc or name make as link
        ];
    }
}
