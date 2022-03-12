<?php

namespace App\Formatters\Api;

use App\Models\Item;
use Nkf\General\Classes\BaseFormatter;

class ItemFormatter extends BaseFormatter
{
    public function __construct(
        ItemFieldValueFormatter $fieldValueFormatter
    ) {
        $this->setFormatter(function (Item $item) use (
            $fieldValueFormatter
        ) : array
        {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'fields' => $fieldValueFormatter->formatList($item->fieldValues),
            ];
        });
    }
}
