<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:1000',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:1000',
            'instagram' => 'required|url|max:255',
            'tiktok' => 'required|url|max:255',
            'youtube' => 'required|url|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:20480',
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'site_name.required' => 'Nama situs wajib diisi.',
            'site_name.max' => 'Nama situs maksimal 255 karakter.',

            'site_description.required' => 'Deskripsi situs wajib diisi.',
            'site_description.max' => 'Deskripsi maksimal 1000 karakter.',

            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.max' => 'Nomor telepon maksimal 50 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',

            'address.required' => 'Alamat wajib diisi.',
            'address.max' => 'Alamat maksimal 1000 karakter.',

            'instagram.required' => 'Link Instagram wajib diisi.',
            'instagram.url' => 'Link Instagram harus berupa URL yang valid.',
            'instagram.max' => 'Link Instagram maksimal 255 karakter.',

            'tiktok.required' => 'Link TikTok wajib diisi.',
            'tiktok.url' => 'Link TikTok harus berupa URL yang valid.',
            'tiktok.max' => 'Link TikTok maksimal 255 karakter.',

            'youtube.required' => 'Link YouTube wajib diisi.',
            'youtube.url' => 'Link YouTube harus berupa URL yang valid.',
            'youtube.max' => 'Link YouTube maksimal 255 karakter.',

            'seo_title.required' => 'SEO title wajib diisi.',
            'seo_title.max' => 'SEO title maksimal 255 karakter.',

            'seo_description.required' => 'SEO description wajib diisi.',
            'seo_description.max' => 'SEO description maksimal 1000 karakter.',

            'seo_keywords.required' => 'SEO keywords wajib diisi.',
            'seo_keywords.max' => 'SEO keywords maksimal 500 karakter.',

            'logo.image' => 'File logo harus berupa gambar.',
            'logo.mimes' => 'Logo harus berformat jpg, jpeg, png, atau svg.',
            'logo.max' => 'Ukuran logo maksimal 20MB.',
        ];
    }
}
