<?php

namespace App\Http\Requests\Admin\Cases;

use Illuminate\Foundation\Http\FormRequest;

class ArchiveCase_R extends FormRequest
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
            'type_id'=>'required',
            'desk_id'=>'required',
            'shelf_id'=>'required',
            'folder_code' => 'required|unique:tbl_archive,folder_code',
            'secret_degree'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'type_id.required'=>translate('archive_type').translate('required'),
            'desk_id.required'=>translate('desk').translate('required'),
            'shelf_id.required'=>translate('shelf').translate('required'),
            'folder_code.required'=>translate('folder_code').translate('required'),
            'folder_code.unique'=>translate('folder_code').translate('unique'),
            'secret_degree.required'=>translate('secret_degree').translate('required'),
        ];
    }
}
