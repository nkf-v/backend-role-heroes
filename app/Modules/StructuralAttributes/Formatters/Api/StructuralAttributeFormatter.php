<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Formatters\Api;

use App\Modules\StructuralAttributes\Models\StructuralAttribute;
use App\Modules\StructuralAttributes\Models\StructuralAttributeValue;
use App\Modules\Categories\Formatters\Api\CategoryFormatter;
use Nkf\General\Classes\BaseFormatter;

class StructuralAttributeFormatter extends BaseFormatter
{
    public function __construct(
        CategoryFormatter $categoryFormatter,
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
                'id' => $attribute->id,
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
