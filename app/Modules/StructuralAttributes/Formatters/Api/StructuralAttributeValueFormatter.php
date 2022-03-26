<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Formatters\Api;

use App\Modules\StructuralAttributes\Models\StructuralAttributeValue;
use Nkf\General\Classes\BaseFormatter;

class StructuralAttributeValueFormatter extends BaseFormatter
{
    public function __construct(StructuralFieldValueFormatter $fieldValueFormatter)
    {
        $this->setFormatter(function (StructuralAttributeValue $value) use ($fieldValueFormatter) : array
        {
            $groupName = $value->group->name ?? null;
            return [
                'id' => $value->id,
                'name' => ($groupName === null) ? $value->name : sprintf('%s %s', $groupName, $value->name),
                'description' => $value->description,
                'fields' => $fieldValueFormatter->formatList($value->fieldsValues),
            ];
        });
    }
}
