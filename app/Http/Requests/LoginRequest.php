<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email_id' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages():array
    {
        return [
            'email_id.required' => 'Email ID is required',
            'email_id.email' => 'Please enter a valid Email Address',

            'password.required' => 'Password is required',
        ];
    }
}
