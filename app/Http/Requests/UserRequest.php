<?php declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'login' => 'required|string|min:3|max:255',
            'password' => 'required|string|min:6|max:8|confirmed',
            'password_confirmation' => 'required|string',
        ];
    }
}
