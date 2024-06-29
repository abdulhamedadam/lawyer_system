<?php

namespace App\Http\Requests\Admin\task;

use Illuminate\Foundation\Http\FormRequest;

class TakeemTaskRequest extends FormRequest
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
            'do_necessary'=>'required',
            'accuracy'=>'required',
            'takeem_complet'=>'required',
            'takeem_reason'=>'required',
            'takeem_time_work'=>'required',
        ];
    }
}
