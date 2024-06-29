<?php

namespace App\Http\Requests\Admin\Units;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitsRequest extends FormRequest
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
           // 'office_id'=>'required',
//            'name_en'=>'required',
//            'name_ar'=>'required',
//            'category_id'=>'required',
//            'type_status_id'=>'required',
//            'currency_id'=>'required',
//            'unit_show_type'=>'required',
//            'unit_type_id'=>'required',
//            'description_en'=>'required',
//            'description_ar'=>'required',
//            'size'=>'required',
//            'size_unit'=>'required',
//            'bedroom'=>'required',
//            'bathroom'=>'required',
//            'rooms'=>'required',
//            'floor_num'=>'required',
//            'available_from'=>'required',
//            'year_built'=>'required',
//            'extra_details'=>'required',
//            'country_id'=>'required',
//            'governate_id'=>'required',
//            'city_id'=>'required',
//            'region_id'=>'required',
//            'address_en'=>'required',
//            'address_ar'=>'required',
//            'map_location'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'office_id.required' => (trans('unit.office_required')),
            'category_id.required' => (trans('unit.category_required')),
            'type_status_id.required' => (trans('unit.type_status_required')),
            'unit_show_type.required' => (trans('unit.unit_show_type_required')),
            'currency_id.required' => (trans('unit.currency_required')),
            'name_ar.required' => (trans('unit.name_ar_required')),
            'name_en.required' => (trans('unit.name_en_required')),
        ];
    }
}
