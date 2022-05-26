<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Admin\Orchid\Layouts;

use App\Enums\ValueTypeEnum;
use App\Modules\StructuralAttributes\Models\Field;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class StructureFieldTable extends Table
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
                ->render(function (Field $field) : Link
                {
                    return Link::make($field->name)->route('platform.structure_fields.edit', $field->id);
                }),
            TD::make('type', 'Type')
                ->canSee($this->attributeIsCreated)
                ->render(function (Field $field) : string
                {
                    return ValueTypeEnum::getLabels()[$field->type];
                }),
        ];
    }
}
