<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInputRequest extends FormRequest
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
            'user_input' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

    }
    public function messages()
    {
        return [
            'user_input.required' => 'The user input field is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image size must not exceed 2048 kilobytes.',
        ];
    }
}
