<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TawkelatSaveRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'tawkel_type' => 'required|string|max:255',
            'tawkel_number' => 'required|string|max:255',
            'client_phone' => 'required|numeric',
            'email' => 'nullable|email',
            'documentation_date' => 'nullable|date',
            'tawkel_date' => 'nullable|date',
        ];
    }
}
