<?php

namespace App\Http\Requests\Admin\caseStatus;

use Illuminate\Foundation\Http\FormRequest;

class AddCaseStatusRequest extends FormRequest
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
            'code' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'case_status_id' => 'required|exists:tbl_cases_settings,id',
            'lawyer_id' => 'required|exists:employees,id',
            'case_archive_id' => 'required|string|max:255',
            'reasons' => 'required|string',
            'notes' => 'required|string',
        ];
    }
}
