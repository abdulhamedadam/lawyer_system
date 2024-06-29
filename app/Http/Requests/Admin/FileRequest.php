<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file.*' => 'mimes:jpeg,png,pdf,docx|max:2048',
            'file_name' => 'required',
        ];
    }

    public function messages()
    {
        return[
          'file_name.required'=>translate('file_name').translate('required'),
        ];
    }
}
