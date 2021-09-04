<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\StructuralAttributeValue;
use Nkf\General\Classes\BaseFormatter;

class StructuralAttributeValueFormatter extends BaseFormatter
{
    public function __construct(StructuralFieldValueFormatter $fieldValueFormatter)
    {
        $this->setFormatter(function (StructuralAttributeValue $value) use ($fieldValueFormatter) : array
        {
            return [
                'id' => $value->id,
                'name' => $value->name,
                'description' => $value->description,
                'fields' => $fieldValueFormatter->formatList($value->fieldsValues),
            ];
        });
    }
}
