<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Formatters\Api;

use App\Enums\ValueTypeEnum;
use App\Modules\StructuralAttributes\Models\StructuralFieldValue;
use Nkf\General\Classes\BaseFormatter;

class StructuralFieldValueFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (StructuralFieldValue $fieldValue) : array
        {
            return [
                'name' => $fieldValue->field->name,
                'value' => $fieldValue->value,
                'type' => ValueTypeEnum::getValues()[$fieldValue->getType()],
            ];
        });
    }
}
