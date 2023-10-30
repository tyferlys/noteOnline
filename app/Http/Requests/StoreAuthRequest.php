<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "login" => "string|required|unique:users",
            "password" => "string|required|min:6",
            "passwordRepeat" => "string|required|min:6|same:password",
        ];
    }

    public function messages(){
        return [
            'login.string' => "Поле обязательно для заполнения",
            "login.required" => "Поле обязательно для заполнения",
            "login.unique" => "Такой логин уже существует",

            'password.string' => "Поле обязательно для заполнения",
            "password.required" => "Поле обязательно для заполнения",
            "password.min" => "Минимальная длина пароля 6 символов",

            'passwordRepeat.string' => "Поле обязательно для заполнения",
            "passwordRepeat.required" => "Поле обязательно для заполнения",
            "passwordRepeat.same" => "Пароли не совпадают",
        ];
    }
}
