<?php

namespace App\Http\Requests\Admin\mo7dareen;

use Illuminate\Foundation\Http\FormRequest;

class AddMo7dareenRequest extends FormRequest
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
            'mo7dareen_num'=>'required',
            'year'=>'required',
            'delivery_date'=>'required',
            'lawyer'=>'required',
            'mo7dareen_pen'=>'required',
            'session_date'=>'required',
            'notes'=>'required',
        ];
    }
}
