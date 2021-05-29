<?php declare(strict_types=1);

namespace App\Formatters\Api;

use App\Enums\AttributeTypeEnum;
use App\Models\StructureField;
use Nkf\General\Classes\BaseFormatter;

class StructureFieldFormatter extends BaseFormatter
{
    public function __construct()
    {
        $this->setFormatter(function (StructureField $field) : array
        {
            return [
                'name' => $field->name,
                'type' => AttributeTypeEnum::getValues()[$field->type],
            ];
        });
    }
}
