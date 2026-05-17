<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessSalaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method_id' => ['required', 'string', 'starts_with:pm_'],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_method_id.required' => 'No payment method received from Stripe.',
        ];
    }
}
