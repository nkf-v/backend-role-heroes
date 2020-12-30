<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'type_value' => 'required|integer',
            'game_id' => 'required|integer',
            'category_id' => 'required|integer',
        ];
    }
}
