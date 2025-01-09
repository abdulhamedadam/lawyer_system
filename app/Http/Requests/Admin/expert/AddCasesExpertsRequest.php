<?php

namespace App\Http\Requests\Admin\expert;

use Illuminate\Foundation\Http\FormRequest;

class AddCasesExpertsRequest extends FormRequest
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
            'expert_num' => 'required|integer|min:1',
            'year' => 'required|integer|min:2000',
            'expert_name' => 'required|string|max:255',
            'lawyer' => 'required|exists:employees,id',
            'visit_date' => 'required|date',
            'delivery_date' => 'required|date|after_or_equal:visit_date',
            'notes' => 'required|string|max:5000',
        ];
    }
}
