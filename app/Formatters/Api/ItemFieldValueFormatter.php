<?php

namespace App\Formatters\Api;

use App\Enums\AttributeTypeEnum;
use App\Models\ItemFieldValue;
use Nkf\General\Classes\BaseFormatter;

class ItemFieldValueFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (ItemFieldValue $value) : array
        {
            return [
                'name' => $value->field->name,
                'value' => $value->value,
                'type' => AttributeTypeEnum::getValues()[$value->getType()],
            ];
        });
    }
}
