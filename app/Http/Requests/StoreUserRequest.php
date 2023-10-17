<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:255', 'unique:users,nik'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string'],
            'pt' => ['required', 'string', 'max:255'],
            'plant' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'role' => ['required', 'string', 'max:255'],
        ];
    }
}
