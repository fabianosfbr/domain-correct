<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEmailRequest extends FormRequest
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
            // Array of data to validate.
            'data' => 'required|array',
            // Each item in the array should be an object with an email property.
            'data.*.email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'data.required' => 'É obrigatório o array de dados contendo o email',
            'data.*.email' => 'E-mail informado é inválido',
        ];
    }
}

