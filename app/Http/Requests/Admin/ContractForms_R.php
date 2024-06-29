<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ContractForms_R extends FormRequest
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
            'contract_name'=>'required',
            'contract_body'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'contract_name.required'=>translate('contract_name').''.translate('required'),
            'contract_body.required'=>translate('contract_body').''.translate('required'),

        ];
    }
}
