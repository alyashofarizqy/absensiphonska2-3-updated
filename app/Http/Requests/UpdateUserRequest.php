<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'nik' => ['required', 'string', 'max:255', 'unique:users,nik,' . $this->user->id],
            'name' => ['required', 'string', 'max:255'],
            'plant' => ['required', 'string', 'max:255'],
            'pt' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
        ];
    }
}
