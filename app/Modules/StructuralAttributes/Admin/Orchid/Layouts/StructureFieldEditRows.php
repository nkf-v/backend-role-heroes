<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Admin\Orchid\Layouts;

use App\Enums\ValueTypeEnum;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class StructureFieldEditRows extends Rows
{
    protected function fields() : array
    {
        return [
            Input::make('field.name')
                ->title('Name')
                ->required(),
            Select::make('field.type')
                ->title('Type')
                ->disabled()
                ->options(ValueTypeEnum::getLabels()),
        ];
    }
}
