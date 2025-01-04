<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddCasesKafalateRequest extends FormRequest
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
           'kafala_num'=>'required',
           'year'=>'required',
           'qasema_num'=>'required',
           'payment_date'=>'required',
           'kafala_value'=>'required',
           'paper_num'=>'required',
           'al7ukm'=>'required',
           'notes'=>'required',
        ];
    }
}
