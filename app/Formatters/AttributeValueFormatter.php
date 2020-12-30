<?php declare(strict_types=1);

namespace App\Formatters;

use App\Models\AttributeValue;
use Nkf\General\Classes\BaseFormatter;

class AttributeValueFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (AttributeValue $value) : array
        {
            return [
                'name' => $value->attribute->name,
                'type_value' => $value->attribute->getTypeValueLabel(),
                'value' => $value->value,
            ];
        });
    }
}
