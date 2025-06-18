<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyContactRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|min:2',
            'phone' => 'required|string|max:20|min:10',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000|min:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your full name.',
            'name.min' => 'Name must be at least 2 characters.',
            'phone.required' => 'Please enter your phone number.',
            'phone.min' => 'Phone number must be at least 10 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Message must be at least 10 characters.',
            'message.max' => 'Message cannot exceed 1000 characters.',
        ];
    }
}
