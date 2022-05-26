<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Admin\Orchid\Layouts;

use App\Enums\ValueTypeEnum;
use App\Modules\StructuralAttributes\Models\FieldValue;
use Illuminate\Database\Eloquent\Collection;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;

class StructuralFieldValuesRows extends Rows
{
    protected bool $isCreate;
    /** @var FieldValue[] */
    protected ?Collection $fieldValues;

    /** @param FieldValue[] $fieldValues */
    public function __construct(bool $isCreate, ?Collection $fieldValues)
    {
        $this->isCreate = $isCreate;
        $this->fieldValues = $fieldValues;
    }

    protected function fields() : array
    {
        $fields = [];
        if (!$this->isCreate)
        {
            foreach ($this->fieldValues as $fieldValue)
            {
                switch ($fieldValue->field->type)
                {
                    case ValueTypeEnum::STRING:
                        $fields[] = Input::make('field_values.' . $fieldValue->id)
                            ->title($fieldValue->field->name)
                            ->value($fieldValue->value);
                    break;
                    case ValueTypeEnum::INT:
                    case ValueTypeEnum::DOUBLE:
                        $fields[] = Input::make('field_values.' . $fieldValue->id)
                            ->title($fieldValue->field->name)
                            ->value($fieldValue->value)
                            ->type('number');
                    break;
                    case ValueTypeEnum::BOOL:
                        $fields[] = Switcher::make('field_values.' . $fieldValue->id)
                            ->title($fieldValue->field->name)
                            ->checked($fieldValue->value)
                            ->sendTrueOrFalse();
                    break;
                    default:
                }
            }
        }

        return $fields;
    }
}
