<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpenAuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "login" => "string|required",
            "password" => "string|min:6|required",
        ];
    }

    public function messages(){
        return [
            'login.string' => "Поле обязательно для заполнения",
            "login.required" => "Поле обязательно для заполнения",
            'password.string' => "Поле обязательно для заполнения",
            "password.required" => "Поле обязательно для заполнения",
            "password.min" => "Минимальная длина пароля 6 символов",
        ];
    }
}
