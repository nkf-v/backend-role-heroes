<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Formatters\Api;

use App\Enums\ValueTypeEnum;
use App\Modules\StructuralAttributes\Models\Field;
use Nkf\General\Classes\BaseFormatter;

class StructureFieldFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (Field $field) : array
        {
            return [
                'name' => $field->name,
                'type' => ValueTypeEnum::getValues()[$field->type],
            ];
        });
    }
}
