<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            // Required
            'username' => ['required', 'string', 'max:16', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            // Optional
            'description' => ['nullable', 'string', 'max:45'],
            'activity_id' => ['nullable', 'integer', 'exists:activities,id'],
            'location_id' => ['nullable', 'integer'],
            'age' => ['nullable', 'string', 'max:45'],
        ];
    }
}
