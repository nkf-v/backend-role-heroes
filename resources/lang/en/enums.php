<?php

use App\Enums\ValueTypeEnum;
use App\Enums\ItemTypeEnum;

return [
    ValueTypeEnum::class => [
        ValueTypeEnum::INT => 'Integer',
        ValueTypeEnum::STRING => 'String',
        ValueTypeEnum::BOOL => 'Boolean',
        ValueTypeEnum::DOUBLE => 'Double',
    ],
    ItemTypeEnum::class => [
        ItemTypeEnum::ITEM => 'Item',
        ItemTypeEnum::WEAPON => 'Weapon',
        ItemTypeEnum::ARMOR => 'Armor',
    ],
];
