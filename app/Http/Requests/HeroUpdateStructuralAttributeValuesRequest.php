<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroUpdateStructuralAttributeValuesRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'value_ids' => 'required|array',
            'value_ids.*' => 'integer',
        ];
    }
}
