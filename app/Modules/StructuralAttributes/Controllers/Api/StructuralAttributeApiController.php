<?php declare(strict_types=1);

namespace App\Modules\StructuralAttributes\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Modules\StructuralAttributes\Formatters\Api\StructuralAttributeValueFormatter;
use App\Modules\StructuralAttributes\Models\StructuralAttribute;
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
