<?php declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Formatters\Api\StructuralAttributeValueFormatter;
use App\Models\StructuralAttribute;
use Illuminate\Http\JsonResponse;
use Nkf\Laravel\Classes\Exceptions\ServerError;

class StructuralAttributeApiController extends ApiController
{
    public function getValues(int $attributeId, StructuralAttributeValueFormatter $formatter) : JsonResponse
    {
        $attribute = StructuralAttribute::find($attributeId);
        if ($attribute === null)
            throw new ServerError(['attribute_id' => ['invalid_value']]);

        return $this->respondedFormatListContent($attribute->values, $formatter);
    }
}
