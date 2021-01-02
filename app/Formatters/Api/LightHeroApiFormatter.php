<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\UserHero;
use Nkf\General\Classes\BaseFormatter;

class LightHeroApiFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (UserHero $hero) : array
        {
            return [
                'id' => $hero->id,
                'name' => $hero->name,
            ];
        });
    }
}
