<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Models\Characteristic;
use Nkf\General\Classes\BaseFormatter;

class HeroCharacteristicApiFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (Characteristic $characteristic) : array
        {
            return [
                'id' => $characteristic->id,
                'name' => $characteristic->name,
                'description' => $characteristic->description,
                'value' => $characteristic->pivot->value ?? null,
            ];
        });
    }
}
