<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DriverCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'nullable|string|unique:drivers,employee_id',
            'full_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'license_number' => 'nullable|string|unique:drivers,license_number',
            'license_expiry_date' => 'nullable|date',
            'license_category' => 'nullable|string|max:100',
            'status' => 'required|in:Active,Inactive',
            'remarks' => 'nullable|string|max:1000',

            // assignment
            'vehicle_ids' => 'nullable|array',
            'vehicle_ids.*' => 'integer|exists:vehicles,id',
        ];
    }
}

