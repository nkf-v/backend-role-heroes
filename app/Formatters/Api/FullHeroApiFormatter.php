<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\Hero;
use Nkf\General\Classes\BaseFormatter;

class FullHeroApiFormatter extends BaseFormatter
{
    public function __construct(HeroCharacteristicApiFormatter $characteristicFormatter, HeroAttributeValueApiFormatter $attributeValueFormatter)
    {
        $this->setFormatter(function (Hero $hero) use ($characteristicFormatter, $attributeValueFormatter) : array
        {
            return [
                'id' => $hero->id,
                'name' => $hero->name,
                'note' => $hero->note,
                'game_id' => $hero->game_id,
                'characteristics' => $characteristicFormatter->formatList($hero->characteristicValues),
                'attributes' => $attributeValueFormatter->formatList($hero->attributeValues),
            ];
        });
    }
}
