<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title Hero wajib diisi.',
            'title.max' => 'Title Hero maksimal 100 karakter.',

            'sub_title.required' => 'Subtitle wajib diisi.',
            'sub_title.max' => 'Subtitle maksimal 255 karakter.',

            'description.required' => 'Deskripsi wajib diisi.',
            'description.max' => 'Deskripsi maksimal 255 karakter.',

            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Logo harus berformat jpg, jpeg, png, atau svg.',
            'image.max' => 'Ukuran logo maksimal 20MB.',
        ];
    }
}
