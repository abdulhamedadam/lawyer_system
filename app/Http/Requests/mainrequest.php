<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class mainrequest extends FormRequest
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
            'name_en' => 'required|unique:maindatas,name->en,'.$this->id,
            'name_ar' => 'required|unique:maindatas,name->ar,'.$this->id,
            'address_en' => 'required|unique:maindatas,address->en,'.$this->id,
            'address_ar' => 'required|unique:maindatas,address->ar,'.$this->id,
            'description_en' => 'required|unique:maindatas,description->en,'.$this->id,
            'description_ar' => 'required|unique:maindatas,description->ar,'.$this->id,
            'phone' => 'required',
            'image' => 'required',
            'email' => 'required|email',
        ];
    }
}
