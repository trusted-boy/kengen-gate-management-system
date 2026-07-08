<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        // Kept for backward compatibility; DriverController uses DriverCreateRequest / DriverUpdateRequest.
        return [];
    }
}

