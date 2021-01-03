<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable|string|min:3|max:255',
            'note' => 'nullable|string',
        ];
    }
}
