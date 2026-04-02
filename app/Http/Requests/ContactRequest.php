<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5|max:35',
            'email' => ['required', 'min:5', 'max:100', 'email'],
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Пожалуйста, введите ваше имя',
            'email.required' => 'Пожалуйста, введите вашу почту',
            'subject.required' => 'Пожалуйста, введите тему вашего обращения',
            'message.required' => 'Пожалуйста, введите ваше сообщение',
            'name.min' => 'Имя должно быть не менее 5 символов',
        ];
    }
}
