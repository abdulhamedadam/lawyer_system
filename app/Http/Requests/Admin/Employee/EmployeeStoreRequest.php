<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
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
            'employee_name'=>'required',
            'nationality_id'=>'required',
            'gender'=>'required',
            'national_id'=>'required',
            'date_of_barth'=>'required',
            'address'=>'required',
            'religion'=>'required',
            'marital_status'=>'required',
            'job_title'=>'required',
            'phone_number'=>'required',
            'whats_number'=>'required',
            'governate_id'=>'required',
            'start_work_date'=>'required',
            'end_contract_date'=>'required',
            'test_num_month'=>'required',
           // 'manager'=>'required',
            'qualifications'=>'required',
            'degrees'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'employee_name.required'=>translate('employee_name').''.translate('required'),
            'nationality_id.required'=>translate('nationality').''.translate('required'),
            'gender.required'=>translate('gender').''.translate('required'),
            'date_of_barth.required'=>translate('date_of_barth').''.translate('required'),
            'address.required'=>translate('address').''.translate('required'),
            'religion.required'=>translate('religion').''.translate('required'),
            'material_status.required'=>translate('material_status').''.translate('required'),
            'job_title.required'=>translate('job_title').''.translate('required'),
            'governate_id.required'=>translate('governate').''.translate('required'),
            'start_work_date.required'=>translate('start_work_date').''.translate('required'),
            'end_contract_date.required'=>translate('end_contract_date').''.translate('required'),
            'test_num_month.required'=>translate('test_number_month').''.translate('required'),
            'manager.required'=>translate('manager').''.translate('required'),
            'qualifications.required'=>translate('qualifications').''.translate('required'),
            'degrees.required'=>translate('degrees').''.translate('required'),
        ];
    }
}
