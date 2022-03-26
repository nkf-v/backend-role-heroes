<?php

namespace App\Modules\Users\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'login' => 'required',
            'password' => 'required|min:6|max:8',
        ];
    }
}
