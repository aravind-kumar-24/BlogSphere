<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'profession' => 'required|string|max:50',
            'state' => 'required',
            'city' => 'required',
            'gender' => 'required|in:Male,Female,Others',
            'date_of_birth' => 'required|date|before_or_equal:today',
            'address' => 'required|string|max:255',
            'profile_pic'=> 'mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First Name is required',

            'last_name.required' => 'Last Name is required',
            
            'profession.required' => 'Profession is required',

            'state.required' => 'Please select a State',
            
            'city.required' => 'Please select a City',
            
            'gender.required' => 'Gender is required',
            
            'date_of_birth.required' => 'Date of Birth is required',
            'date_of_birth.before_or_equal' => 'Date of Birth cannot be a future date',
            
            'address.required' => 'Address is required',

            'profile_pic.mimes' => 'Invalid file type, Allowed extensions: jpeg, png, jpg',
            'profile_pic.size' => 'Profile picture must not be greater than 2 mb',
            
        ];
    }
}
