<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:20480',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama destinasi wajib diisi.',
            'name.string'   => 'Nama destinasi harus berupa teks.',
            'name.max'      => 'Nama destinasi tidak boleh lebih dari 255 karakter.',

            'description.required' => 'Deskripsi destinasi wajib diisi.',
            'description.string'   => 'Deskripsi destinasi harus berupa teks.',
            
            'image.image'    => 'File yang diunggah harus berupa gambar.',
            'image.mimes'    => 'Format gambar harus jpg, jpeg, atau png.',
            'image.max'      => 'Ukuran gambar tidak boleh lebih dari 20 MB.',
        ];
    }
}
