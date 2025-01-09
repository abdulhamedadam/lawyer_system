<?php

namespace App\Http\Requests\Admin\tanfizA7kam;

use Illuminate\Foundation\Http\FormRequest;

class AddCasestanfizA7kamRequest extends FormRequest
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
            'partial_num' => 'required|string|max:255',
            'year' => 'required|integer',
            'tanfiz_circle' => 'required|string|max:255',
            'elkady_name' => 'required|string|max:255',
            'elmarkaz' => 'nullable|string|max:255',
            'el7okm_date' => 'required|date',
            'court' => 'required|exists:tbl_cases_settings,id',
            'el7okm' => 'required|string',
        ];
    }
}
