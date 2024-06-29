<?php

namespace App\Http\Requests\Admin\masrofat;

use Illuminate\Foundation\Http\FormRequest;

class MasrofatSave_R extends FormRequest
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
            'related_to_case' => 'required',
            'to_emp_id' => 'required',
            'band_id' => 'required',
            'value' => 'required|numeric',
            'notes' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'related_to_case.required' => translate('related_to_case').' '.translate('required'),
            'to_emp_id.required' => translate('to_emp_id').' '.translate('required'),
            'band_id.required' => translate('band_id').' '.translate('required'),
            'value.required' => translate('value').' '.translate('required'),
            'value.numeric' => translate('value').' '.translate('number'),
            'notes.required' => translate('notes').' '.translate('required'),
        ];
    }
}
