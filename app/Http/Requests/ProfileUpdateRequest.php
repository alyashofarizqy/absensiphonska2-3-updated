<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nik' => [
                'required',
                'string',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'pt' => ['nullable', 'string', 'max:255'],
            'plant' => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
        ];
    }
}
