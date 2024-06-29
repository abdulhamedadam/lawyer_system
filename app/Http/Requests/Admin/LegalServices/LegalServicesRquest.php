<?php

namespace App\Http\Requests\Admin\LegalServices;

use Illuminate\Foundation\Http\FormRequest;

class LegalServicesRquest extends FormRequest
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
            'client_name'      =>'required',
            'type_of_service'  =>'required',
            'esnad_to'         =>'required',
            'cost_of_service'  =>'required',
            //'notes'  =>'required',
        ];
    }


    public function messages()
    {
        return [
            'client_name.required'=>translate('client_name').''.translate('required'),
            'type_of_service.required'=>translate('type_of_service').''.translate('required'),
            'esnad_to.required'=>translate('esnad_to').''.translate('required'),
            'cost_of_service.required'=>translate('cost_of_service').''.translate('required'),
        ];
    }
}
