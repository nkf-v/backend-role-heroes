<?php

namespace App\Formatters\Api;

use App\Models\ItemField;
use Nkf\General\Classes\BaseFormatter;

class ItemFieldFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (ItemField $field) : array
        {
            return [
                'name' => $field->name,
                'type' => $field->item_type,
                'value_type' => $field->value_type,
            ];
        });
    }
}
