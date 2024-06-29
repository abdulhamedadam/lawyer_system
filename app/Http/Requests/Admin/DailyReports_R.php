<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DailyReports_R extends FormRequest
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
            'related_to_case'=>'required',
            'to_emp_id'=>'required',
            'details'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'related_to_case.required'=>translate('related_to_case').''.translate('required'),
            'to_emp_id.required'=>translate('to_emp_id').''.translate('required'),
            'details.required'=>translate('details').''.translate('required'),
        ];
    }
}
