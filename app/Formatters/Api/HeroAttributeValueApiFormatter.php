<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\AttributeValue;
use Nkf\General\Classes\BaseFormatter;

class HeroAttributeValueApiFormatter extends BaseFormatter
{
    public function __construct(CategoryApiFormatter $categoryFormatter)
    {
        $this->setFormatter(function (AttributeValue $attributeValue) use ($categoryFormatter) : array
        {
            return [
                'id' => $attributeValue->attribute->id,
                'name' => $attributeValue->attribute->name,
                'description' => $attributeValue->attribute->description,
                'type_value' => $attributeValue->attribute->type_value,
                'value' => $attributeValue->value,
                'category' => $categoryFormatter->format($attributeValue->attribute->category),
            ];
        });
    }
}
