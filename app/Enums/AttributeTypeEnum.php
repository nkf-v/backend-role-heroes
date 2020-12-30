<?php declare(strict_types=1);

namespace App\Enums;

use Nkf\Laravel\Classes\LaravelEnum;

class AttributeTypeEnum extends LaravelEnum
{
    public const INT = 0;
    public const STRING = 1;
    public const BOOL = 2;
    public const DOUBLE = 3;
}
