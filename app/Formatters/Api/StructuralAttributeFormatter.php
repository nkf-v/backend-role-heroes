<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\StructuralAttribute;
use App\Models\StructuralAttributeValue;
use Nkf\General\Classes\BaseFormatter;

class StructuralAttributeFormatter extends BaseFormatter
{
    public function __construct(
        CategoryApiFormatter $categoryFormatter,
        StructureFieldFormatter $fieldFormatter,
        StructuralAttributeValueFormatter $valueFormatter
    )
    {
        /** @param StructuralAttributeValue[] $selectedValues */
        $this->setFormatter(function (StructuralAttribute $attribute, array $selectedValues) use (
            $categoryFormatter,
            $fieldFormatter,
            $valueFormatter) : array
        {
            return [
                'name' => $attribute->name,
                'description' => $attribute->description,
                'multiply' => $attribute->multiply,
                'category' => $categoryFormatter->format($attribute->category),
                'fields' => $fieldFormatter->formatList($attribute->fields),
                'selected_values' => $valueFormatter->formatList($selectedValues),
            ];
        });
    }
}
