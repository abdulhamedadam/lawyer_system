<?php

namespace App\Http\Requests\Admin\mraf3at;

use Illuminate\Foundation\Http\FormRequest;

class AddCaseMraf3atRequest extends FormRequest
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
            'source' => 'required|string|max:255',
            'mraf3a_name' => 'required|string|max:255',
            'addition_date' => 'required|date|before_or_equal:today',
            'mraf3a_text' => 'required|string|max:500',
        ];
    }
}
