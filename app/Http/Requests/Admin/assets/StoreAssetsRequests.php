<?php

namespace App\Http\Requests\Admin\assets;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetsRequests extends FormRequest
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
            'asset_name'=>'required',
            'assets_type'=>'required',
            'purchases_value'=>'required',
            'purchases_date' => 'required',
            'supplier' => 'required',
            'received_by' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'asset_name.required'=>translate('asset_name').translate('required'),
            'asset_type.required'=>translate('asset_type').translate('required'),
            'purchases_value.required'=>translate('purchases_value').translate('required'),
            'purchases_date.required'=>translate('purchases_date').translate('required'),
            'supplier.required'=>translate('supplier').' '.translate('required'),
            'received_by.required'=>translate('received_by').' '.translate('required'),

        ];
    }
}
