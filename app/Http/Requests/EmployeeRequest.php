<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest

{
    public function authorize(): bool
    {
        return true; // later you can add roles/permissions
    }
    public function rules(): array
    {

        $id = $this->route('employee')?->id;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:2000',
            'department_id' => 'required|exists:departments,id',
            'salary' => 'required|numeric|min:0',
            'joining_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Employee name is required',
            'email.unique' => 'This email is already taken',
            'department_id.required' => 'Please select a department',
        ];
    }
}
