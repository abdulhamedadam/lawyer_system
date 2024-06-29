<?php

namespace App\Http\Requests\Admin\RealEstateOffic;

use Illuminate\Foundation\Http\FormRequest;

class StoreRealEstateOfficeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name_ar' => 'required|unique:host_data,name->ar',
            'name_en' => 'required|unique:host_data,name->en',
            'email' => 'required|email|unique:host_data,email',
            'phone' => 'required|numeric|unique:host_data,phone',
            'num_tax' => 'required|numeric|unique:host_data,num_tax',
            'office_num' => 'required|numeric|unique:host_data,office_num',
            'real_state_image'  => 'sometimes', 'images', 'mimes:svg,png,jpg',
            'user_name'        =>'required',
            'password'        =>'required',
            'address_ar' => 'required',
            'address_en' => 'required',
            'country_id_fk' => 'required',
            'emirate' => 'required',
            'city' => 'required',
        ];
    }
}
