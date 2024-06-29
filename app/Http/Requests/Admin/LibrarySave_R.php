<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LibrarySave_R extends FormRequest
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
            'fe2a'=>'required',
            'book_name'=>'required',
           // 'author'=>'required',
            'book' => 'required|file|mimes:pdf,doc,docx',

        ];
    }

    public function messages()
    {
        return [
            'fe2a.required'=>translate('tasnef_books').''.translate('required'),
            'book_name.required'=>translate('book_name').''.translate('required'),
            'book.required'=>translate('book_name').''.translate('required'),
        ];
    }
}
