<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rules\Password;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required',
            'new_password' => [
                'required',
                'confirmed',
                Password::min(10)->max(15)->mixedCase()->numbers()->symbols()
            ],
            'new_password_confirmation' => 'required'
        ];
    }

    public function messages():array
    {
        return [
            'old_password.required' => 'Old Password is required',

            'new_password.required' => 'New Password is required',
            'new_password.min' => 'New Password must be at least 10 characters',
            'new_password.confirmed' => 'Passwords do not match',
            'new_password.mixedCase' => 'New Password must contain at least one uppercase and one lowercase letter',
            'new_password.numbers' => 'New Password must contain at least one number',
            'new_password.symbols' => 'New Password must contain at least one special character',

            'new_password_confirmation.required' => 'Confirm New Password is required',
        ];
    }
}
