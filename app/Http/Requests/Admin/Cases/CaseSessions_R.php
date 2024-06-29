<?php

namespace App\Http\Requests\Admin\Cases;

use Illuminate\Foundation\Http\FormRequest;

class CaseSessions_R extends FormRequest
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
            'case_id'=>'required',
            'session_title'=>'required',
            'session_date'=>'required',
            'session_time'=>'required',

        ];
    }

    public function messages()
    {
        return [
            'case_id.required'       =>translate('case').''.translate('required'),
            'session_title.required' =>translate('session_title').''.translate('required'),
            'session_date.required'  =>translate('session_date').''.translate('required'),
            'session_time.required'  =>translate('session_time').''.translate('required'),
        ];
    }
}
