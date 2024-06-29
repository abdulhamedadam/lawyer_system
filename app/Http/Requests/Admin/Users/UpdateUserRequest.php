<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class UpdateUserRequest extends FormRequest
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
            'is_employee' => 'required',
            'user_name' => 'required|unique:admins,user_name,'.$this->id,
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'user_role' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'is_employee.required'=>translate('is_employee').''.translate('required'),
            'user_name.required'=>translate('user_name').''.translate('required'),
            'user_name.unique'=>translate('user_name').''.translate('unique'),
            'email.required'=>translate('email').''.translate('required'),
            'phone.required'=>translate('phone').''.translate('required'),
            'password.required'=>translate('password').''.translate('required'),
            'user_role.required'=>translate('user_role').''.translate('required'),
        ];
    }
}
