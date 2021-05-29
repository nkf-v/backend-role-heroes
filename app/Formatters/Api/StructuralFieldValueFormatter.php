<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Enums\AttributeTypeEnum;
use App\Models\StructuralFieldValue;
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
                'type' => AttributeTypeEnum::getValues()[$fieldValue->getType()],
            ];
        });
    }
}
