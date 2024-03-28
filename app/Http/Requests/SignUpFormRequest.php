<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignUpFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fname'=>'required|string|min:4',
            'lname'=>'required|string|min:4',
            'email' => [
                'required',
                'email',
                Rule::unique('e-commerces', 'email'), // Ensure email is unique in the 'e-commerces' table
            ],    
            'password' => 'required|string|min:6',
            'country' => 'required',
            'gender' => 'required|in:male,female,other',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate photo as an image file
            'accept' => 'required', 
            
        ];
       
    }
    public function messages()
    {
        return [
            'fname.required' => 'The first name field is required.',
            'fname.string' => 'The first name must be a alphabet.',
            'fname.min' => 'The first name must be at least 4 characters.',
            'lname.required' => 'The last name field is required.',
            'lname.string' => 'The last name must be a alphabet.',
            'lname.min' => 'The last name must be at least 4 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been used.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 6 characters.',
            'country.required' => 'The country field is required.',
            'gender.required' => 'The gender field is required.',
            'gender.in' => 'The selected gender is invalid.',
            'photo.required' => 'The photo field is required.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif.',
            'photo.max' => 'The photo may not be greater than 2048 kilobytes.',
            'accept.required' => 'You must accept the terms and conditions.',

        ];

}
}