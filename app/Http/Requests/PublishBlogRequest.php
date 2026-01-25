<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublishBlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            'blog_name' => 'required|string|max:25',
            'blog_category' => 'required',
            'blog_description' => 'required|string|max:255',
            'blog_media' => 'required|mimes:png,jpg,jpeg|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'blog_name.required' => 'Blog Name is required',
            'blog_name.max' => 'Blog Name must not be greater than 25 characters',

            'blog_category.required' => 'Blog Category is required',

            'blog_description.required' => 'Blog Description is required',
            'blog_description.max' => 'Blog Description must not be greater than 255 characters',

            'blog_media.required' => 'Blog Image is required',
            'blog_media.mimes' => 'Invalid file type, Allowed extensions: jpeg, png, jpg',
            'blog_media.size' => 'Blog Image must not be greater than 2 mb',

        ];
    }
}
