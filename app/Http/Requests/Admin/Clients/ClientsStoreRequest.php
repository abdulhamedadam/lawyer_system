<?php

namespace App\Http\Requests\Admin\Clients;

use Illuminate\Foundation\Http\FormRequest;

class ClientsStoreRequest extends FormRequest
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
//            'client_name'=>'required',
//            'nationality_id'=>'required',
//            'national_id'=>'required',
//            'gender'=>'required',
//            'date_of_barth'=>'required',
//            'place_of_barth'=>'required',
//            'current_address'=>'required',
//            'religion'=>'required',
//            'marital_status'=>'required',
//            'job_title'=>'required',
//            'work_place'=>'required',
//            'phone_number'=>'required',
//            'whats_number'=>'required',
//            'governate_id'=>'required',
//            'city_id'=>'required',
//            'region'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'client_name.required' => translate('client_name').translate('required'),
            'nationality_id.required' => translate('nationality').translate('required'),
            'national_id.required' => translate('national_id').translate('required'),
            'gender.required'       =>     translate('gender').translate('required'),
            'date_of_barth.required' => translate('date_of_barth').translate('required'),
            'place_of_barth.required' =>  translate('place_of_barth').translate('required'),
            'current_address.required' => translate('current_address').translate('required'),
            'religion.required' => translate('religion').translate('required'),
            'marital_status.required' => translate('material_status').translate('required'),
            'job_title.required' =>  translate('job_title').translate('required'),
            'work_place.required' => translate('work_place').translate('required'),
            'phone_number.required' => translate('phone_number').translate('required'),
            'whats_number.required' => translate('whats_number').translate('required'),
            'governate_id.required' => translate('governate').translate('required'),
            'city_id.required' => translate('city').translate('required'),
            'region.required' => translate('region').translate('required'),
        ];
    }

}
