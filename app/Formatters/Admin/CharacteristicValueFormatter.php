<?php declare(strict_types=1);

namespace App\Formatters\Admin;

use App\Models\Characteristic;
use Nkf\General\Classes\BaseFormatter;

class CharacteristicValueFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (Characteristic $characteristic) : array
        {
            return [
                'name' => $characteristic->name,
                'value' => $characteristic->pivot->value,
            ];
        });
    }
}
