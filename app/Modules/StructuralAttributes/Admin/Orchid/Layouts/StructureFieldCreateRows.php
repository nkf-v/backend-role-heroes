<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Admin\Orchid\Layouts;

use App\Enums\ValueTypeEnum;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class StructureFieldCreateRows extends Rows
{
    protected ?int $attributeId = null;

    public function __construct(?int $attributeId)
    {
        $this->attributeId = $attributeId;
    }

    protected function fields(): array
    {
        return [
            Input::make('new_field.attribute_id')
                ->value($this->attributeId)
                ->hidden(),
            Input::make('new_field.name')
                ->title('Name')
                ->required(),
            Select::make('new_field.type')
                ->title('Type')
                ->required()
                ->options(ValueTypeEnum::getLabels()),
        ];
    }
}
