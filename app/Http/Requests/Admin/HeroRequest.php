<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HeroRequest extends FormRequest
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
            'subtitle' => 'required|string|max:255',
            'button_text' => 'required|string|max:20',
            'youtube_link' => 'required|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:20480',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title Hero wajib diisi.',
            'title.max' => 'Title Hero maksimal 100 karakter.',

            'subtitle.required' => 'Deskripsi hero wajib diisi.',
            'subtitle.max' => 'Deskripsi maksimal 255 karakter.',

            'button_text.required' => 'Button Text wajib diisi.',
            'button_text.max' => 'Nomor telepon maksimal 20 karakter.',

            'youtube_link.required' => 'Link YouTube wajib diisi.',
            'youtube_link.url' => 'Link YouTube harus berupa URL yang valid.',

            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Logo harus berformat jpg, jpeg, png, atau svg.',
            'image.max' => 'Ukuran logo maksimal 20MB.',
        ];
    }
}
