<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroCharacteristicUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
             'value' => 'required|integer',
        ];
    }
}
