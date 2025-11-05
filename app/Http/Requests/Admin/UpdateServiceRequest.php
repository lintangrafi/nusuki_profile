<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul layanan wajib diisi.',
            'title.string' => 'Judul layanan harus berupa teks.',
            'title.max' => 'Judul layanan maksimal 255 karakter.',
            'icon.string' => 'Nama kelas ikon harus berupa teks.',
            'icon.max' => 'Nama kelas ikon maksimal 255 karakter.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ];
    }
}