<?php declare(strict_types=1);

namespace App\Enums;

use Nkf\Laravel\Classes\LaravelEnum;

class ItemTypeEnum extends LaravelEnum
{
    public const ITEM = 0;
    public const WEAPON = 1;
    public const ARMOR = 2;
}
