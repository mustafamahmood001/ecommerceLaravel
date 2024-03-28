<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userProfileRequest extends FormRequest
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
            'fname'    => 'required|string|min:3',
            'lname'    => 'required|string|min:3',
            'country'  => 'required',
            'city'  => 'required',
            'gender'   => 'required',
        ];
        
    }
    public function messages(){
        return [
            'fname.required' => 'Field is required',
            'fname.string' => 'Name must be a string',
            'fname.min' => 'Mininmum 3 character required',
            'lname.required' => 'Field is required',
            'lname.string' => 'Name must be a string',
            'lname.min' => 'Mininmum 3 character required',
            'country.required'  => 'Field is required',
            'city.required'  => 'Field is required',
            'gender.required'   => 'Field is required',
        ];


    }
}
