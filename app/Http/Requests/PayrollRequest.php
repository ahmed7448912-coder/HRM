<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PayrollRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'basic_salary' => 'required|numeric|min:0',
            'absents' => 'required|integer|min:0',
            'leaves' => 'required|integer|min:0',
            'deductions' => 'required|numeric|min:0',
            'bonus' => 'required|numeric|min:0',
        ];
    }
}
