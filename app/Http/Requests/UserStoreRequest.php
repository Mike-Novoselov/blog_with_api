<?php

// Request - используется для валидации

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',  // Имя обязательно, строка, максимум 255 символов
            'email' => 'required|email|unique:users',  // Email обязателен, должен быть уникальным в таблице users
            'password' => 'required|string|min:4',  // Пароль обязателен, минимум 4 символов
        ];
    }
}
