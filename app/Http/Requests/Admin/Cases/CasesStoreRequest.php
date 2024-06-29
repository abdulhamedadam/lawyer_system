<?php

namespace App\Http\Requests\Admin\Cases;

use Illuminate\Foundation\Http\FormRequest;

class CasesStoreRequest extends FormRequest
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
//            'client_id'       =>'required',
//            'case_title'       =>'required',
//            'case_status'     =>'required',
//            'case_title'      =>'required',
//            'case_type'       =>'required',
//            'court_id'        =>'required',
//            'fees'            =>'required',
//            'start_date'      =>'required',
//            'notes'           =>'required',
        ];
    }

    public function messages()
    {
       return[
         'client_id.required'=>translate('client').translate('required'),
         'case_status.required'=>translate('case_status').translate('required'),
         'case_title.required'=>translate('case_title').translate('required'),
         'court_id.required'=>translate('court').translate('required'),
         'fees.required'=>translate('fees').translate('required'),
         'start_date.required'=>translate('start_date').translate('required'),
         'notes.required'=>translate('notes').translate('required'),
       ];
    }
}
