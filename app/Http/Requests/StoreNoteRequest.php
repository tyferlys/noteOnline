<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "title" => "string|required",
            "text" => "string|required"
        ];
    }
    public function messages(){
        return [
            'title.string' => "Поле обязательно для заполнения",
            "title.required" => "Поле обязательно для заполнения",

            'text.string' => "Поле обязательно для заполнения",
            "text.required" => "Поле обязательно для заполнения",
        ];
    }
}
