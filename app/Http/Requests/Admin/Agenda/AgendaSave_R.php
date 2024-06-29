<?php

namespace App\Http\Requests\Admin\Agenda;

use Illuminate\Foundation\Http\FormRequest;

class AgendaSave_R extends FormRequest
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
            'title'=>'required',
            'description'=>'required',
            'start'=>'required',
            'end'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>translate('title').''.translate('required'),
            'description.required'=>translate('description').''.translate('required'),
            'start.required'=>translate('start').''.translate('required'),
            'end.required'=>translate('end').''.translate('required'),
        ];
    }
}
