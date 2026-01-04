<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'user_name' => 'required|string|max:50',
            'profession' => 'required|string|max:50',
            'email_id' => 'required|email|max:100',
            'contact_number'=> 'required|string|max:10',
            'state' => 'required',
            'city' => 'required',
            'gender' => 'required|in:Male,Female,Others',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'address' => 'required|string|max:255',
            'profile_pic'=> 'required|mimes:jpeg,png,jpg|max:2048',
            'password' => [
                'required',
                'confirmed',
                Password::min(10)->mixedCase()->numbers()->symbols()
            ],
            'password_confirmation'=> 'required|min:10',
            'terms_and_conditions' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First Name is required',

            'last_name.required' => 'Last Name is required',
            
            'user_name.required' => 'User Name is required',
            
            'profession.required' => 'Profession is required',

            'email_id.required' => 'Email ID is required',
            'email_id.email' => 'Please enter a valid Email Address',

            'contact_number.required' => 'Contact Number is required',
            'contact_number.max' => 'Contact Number must not be greater than 10 characters',
            
            'state.required' => 'Please select a State',
            
            'city.required' => 'Please select a City',
            
            'gender.required' => 'Gender is required',
            
            'date_of_birth.required' => 'Date of Birth is required',
            'date_of_birth.before_or_equal' => 'Date of Birth cannot be a future date',
            
            'address.required' => 'Address is required',

            'profile_pic.required' => 'Profile picture is required',
            'profile_pic.mimes' => 'Invalid file type, Allowed extensions: jpeg, png, jpg',
            'profile_pic.size' => 'Profile picture must not be greater than 2 mb',

            
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 10 characters',
            'password.confirmed' => 'Passwords do not match',
            'password.mixed' => 'Password must contain at least one uppercase and one lowercase letter',
            'password.numbers' => 'Password must contain at least one number',
            'password.symbols' => 'Password must contain at least one special character',
            
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.min' => 'Confirm Password must be at least 10 characters',
            
            'terms_and_conditions.required' => 'Terms & Conditions are required',
        ];
    }
}
