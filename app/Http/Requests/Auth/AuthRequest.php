<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user_name'  => 'required|max:255',
            'user_token' => 'required|max:255',
        ];
    }
}
