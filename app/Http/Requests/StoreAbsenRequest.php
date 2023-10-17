<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsenRequest extends FormRequest
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
            'photo' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->input('photo')) {
            $raw = $this->input('photo');
            @list($type, $raw) = explode(';', $raw);
            @list(, $raw) = explode(',', $raw);

            $this->merge([
                'photo' => $raw,
            ]);
        }
    }
}
