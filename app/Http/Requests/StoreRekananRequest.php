<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRekananRequest extends FormRequest
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
            'nama' => ['required', 'string', 'min:3', 'max:255'],
            'telepon' => ['required', 'string', 'min:3', 'max:255'],
            'unit' => ['required', 'string', 'min:3', 'max:255'],
            'item' => ['required', 'string', 'min:3', 'max:255'],
            'pekerjaan' => ['required', 'string', 'min:3', 'max:255'],
            'no_permit' => ['required', 'string', 'min:3', 'max:255'],
            'rekanan' => ['required', 'string', 'min:3', 'max:255'],
            'open' => ['required', 'string', 'date_format:H:i'],
            'close' => ['required', 'string', 'date_format:H:i'],
        ];
    }

}
