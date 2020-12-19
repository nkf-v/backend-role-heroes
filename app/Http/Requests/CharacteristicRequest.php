<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CharacteristicRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
             'name' => 'required|string|min:2|max:255',
             'description' => 'required|string|min:3|max:255',
             'game_id' => 'required|int',
        ];
    }
}
