<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Enums\ValueTypeEnum;
use App\Models\AttributeValue;
use App\Modules\Categories\Formatters\Api\CategoryFormatter;
use Nkf\General\Classes\BaseFormatter;

class HeroAttributeValueApiFormatter extends BaseFormatter
{
    public function __construct(CategoryFormatter $categoryFormatter)
    {
        $this->setFormatter(function (AttributeValue $attributeValue) use ($categoryFormatter) : array
        {
            return [
                'id' => $attributeValue->attribute->id,
                'name' => $attributeValue->attribute->name,
                'description' => $attributeValue->attribute->description,
                'type' => ValueTypeEnum::getValues()[$attributeValue->attribute->type_value],
                'value' => $attributeValue->value,
                'category' => $categoryFormatter->format($attributeValue->attribute->category),
            ];
        });
    }
}
