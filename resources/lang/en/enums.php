<?php

use App\Enums\AttributeTypeEnum;

return [
    AttributeTypeEnum::class => [
        AttributeTypeEnum::INT => 'Integer',
        AttributeTypeEnum::STRING => 'String',
        AttributeTypeEnum::BOOL => 'Boolean',
        AttributeTypeEnum::DOUBLE => 'Double',
    ],
];
