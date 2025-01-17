<?php

namespace App\Http\Requests\Admin\edaryWork;

use Illuminate\Foundation\Http\FormRequest;

class AddEdaryWorkRequest extends FormRequest
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
            'estlam_date' => 'required|date',
            'date_authority' => 'required|date',
            'client_id' => 'required|exists:tbl_clients,id',
            'phone' => 'nullable|string|max:15',
            'tawkel_id' => 'required|exists:tbl_tawkelat,id',
            'tawkel_type' => 'nullable|string|max:255',
            'edary_work_type' => 'required|exists:tbl_cases_settings,id',
            'esnad_to_id' => 'required|exists:employees,id',
            'subject_entity' => 'required|string|max:255',
            'authority_entity' => 'required|string|max:255',
            'subject_entity_address' => 'required|string|max:255',
            'total_fees' => 'required|numeric|min:0',
            'subject' => 'nullable|string|max:1000',
        ];
    }
}
