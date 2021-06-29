<?php

use App\Enums\AttributeTypeEnum;
use App\Enums\ItemTypeEnum;

return [
    AttributeTypeEnum::class => [
        AttributeTypeEnum::INT => 'Integer',
        AttributeTypeEnum::STRING => 'String',
        AttributeTypeEnum::BOOL => 'Boolean',
        AttributeTypeEnum::DOUBLE => 'Double',
    ],
    ItemTypeEnum::class => [
        ItemTypeEnum::ITEM => 'Item',
        ItemTypeEnum::WEAPON => 'Weapon',
        ItemTypeEnum::ARMOR => 'Armor',
    ],
];
