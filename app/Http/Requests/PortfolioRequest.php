<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'resume' => $this->isMethod('post') ? 'required|file|mimes:pdf|max:2048' : 'nullable|file|mimes:pdf|max:2048',
            'phone' => 'required|string',
            'address' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.max' => 'The first name may not be greater than 255 characters.',
            'last_name.required' => 'The last name is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.max' => 'The last name may not be greater than 255 characters.',
            'resume.required' => 'The resume is required when creating a portfolio.',
            'resume.file' => 'The resume must be a file.',
            'resume.mimes' => 'The resume must be a PDF file.',
            'resume.max' => 'The resume may not be greater than 2 MB.',
            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a string.',
            'address.required' => 'The address is required.',
            'address.string' => 'The address must be a string.',
        ];
    }
}
