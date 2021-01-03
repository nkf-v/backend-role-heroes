<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'game_id' => 'required|integer',
            'note' => 'nullable|string',
        ];
    }
}
