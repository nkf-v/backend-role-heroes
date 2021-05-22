<?php declare(strict_types=1);

namespace App\Orchid\Layouts\StructuralAttribute;

use App\Enums\AttributeTypeEnum;
use App\Models\StructureField;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StructureFieldListTable extends Table
{
    protected $attributeIsCreated = true;
    protected $target = 'fields';

    public function __construct(bool $attributeIsCreated)
    {
        $this->attributeIsCreated = $attributeIsCreated;
    }

    protected function columns() : array
    {
        return [
            TD::make('name', 'Name')
                ->canSee($this->attributeIsCreated)
                ->render(function (StructureField $field) : Link
                {
                    return Link::make($field->name)->route('platform.structure_fields.edit', $field->id);
                }),
            TD::make('type', 'Type')
                ->canSee($this->attributeIsCreated)
                ->render(function (StructureField $field) : string
                {
                    return AttributeTypeEnum::getLabels()[$field->type];
                }),
        ];
    }
}
