<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\Hero;
use App\Models\StructuralAttributeValue;
use Nkf\General\Classes\BaseFormatter;
use Nkf\General\Utils\ArrayUtils;

class FullHeroApiFormatter extends BaseFormatter
{
    public function __construct(
        HeroCharacteristicApiFormatter $characteristicFormatter,
        HeroAttributeValueApiFormatter $attributeValueFormatter,
        StructuralAttributeFormatter $structuralAttributeFormatter,
        ItemFormatter $itemFormatter
    )
    {
        $this->setFormatter(function (Hero $hero) use (
            $characteristicFormatter,
            $attributeValueFormatter,
            $structuralAttributeFormatter,
            $itemFormatter
        ) : array
        {
            $valuesByStructuralAttribute = [];
            foreach ($hero->structuralAttributeValues as $value)
                $valuesByStructuralAttribute[$value->attribute_id][] = $value;

            $structuralAttributes = [];
            foreach ($hero->game->structuralAttributes as $attribute)
                $structuralAttributes[] = $structuralAttributeFormatter->format($attribute, ['selectedValues' => $valuesByStructuralAttribute[$attribute->id] ?? []]);

            return [
                'id' => $hero->id,
                'name' => $hero->name,
                'note' => $hero->note,
                'game_id' => $hero->game_id,
                'characteristics' => $characteristicFormatter->formatList($hero->characteristicValues),
                'attributes' => $attributeValueFormatter->formatList($hero->attributeValues),
                'structural_attributes' => $structuralAttributes,
                'items' => $itemFormatter->formatList($hero->items),
            ];
        });
    }
}
