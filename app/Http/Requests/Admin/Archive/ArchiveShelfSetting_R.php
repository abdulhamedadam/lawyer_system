<?php

namespace App\Http\Requests\Admin\Archive;

use Illuminate\Foundation\Http\FormRequest;

class ArchiveShelfSetting_R extends FormRequest
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
            'desk_name'=>'required',
            'shelf_name'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'desk_name.required'=>translate('desk_name').translate('required'),
            'shelf_name.required'=>translate('desk_name').translate('required'),
        ];
    }
}
