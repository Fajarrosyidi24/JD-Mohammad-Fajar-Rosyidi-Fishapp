<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShippingAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name'      => 'required|string|max:255',
            'email'          => 'nullable|email|max:255',
            'country_code'   => 'required|string|max:5',
            'phone'          => 'required|string|max:20',
            'country'        => 'required|string|max:100',
            'address'        => 'required|string|max:500',
            'province_id'    => 'required|string',
            'city_id'        => 'required|string',
            'subdistrict_id' => 'required|string',
            'village_id'     => 'required',
            'zip_code'       => 'required|string|max:10',
            'latitude'       => 'nullable|string|max:50',
            'longitude'      => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required'      => 'Nama lengkap wajib diisi.',
            'full_name.string'        => 'Nama lengkap harus berupa teks.',
            'full_name.max'           => 'Nama lengkap maksimal 255 karakter.',

            'email.email'             => 'Format email tidak valid.',
            'email.max'               => 'Email maksimal 255 karakter.',

            'country_code.required'   => 'Kode negara wajib diisi.',
            'country_code.string'     => 'Kode negara harus berupa teks.',
            'country_code.max'        => 'Kode negara maksimal 5 karakter.',

            'phone.required'          => 'Nomor telepon wajib diisi.',
            'phone.string'            => 'Nomor telepon harus berupa teks.',
            'phone.max'               => 'Nomor telepon maksimal 20 karakter.',

            'country.required'        => 'Negara wajib diisi.',
            'country.string'          => 'Negara harus berupa teks.',
            'country.max'             => 'Negara maksimal 100 karakter.',

            'address.required'        => 'Alamat wajib diisi.',
            'address.string'          => 'Alamat harus berupa teks.',
            'address.max'             => 'Alamat maksimal 500 karakter.',

            'province_id.required'    => 'Provinsi wajib dipilih.',
            'province_id.string'      => 'Provinsi harus berupa teks.',

            'city_id.required'        => 'Kota/Kabupaten wajib dipilih.',
            'city_id.string'          => 'Kota/Kabupaten harus berupa teks.',

            'subdistrict_id.required' => 'Kecamatan wajib dipilih.',
            'subdistrict_id.string'   => 'Kecamatan harus berupa teks.',

            'village_id.required'     => 'Desa/Kelurahan wajib dipilih.',

            'zip_code.required'       => 'Kode pos wajib diisi.',
            'zip_code.string'         => 'Kode pos harus berupa teks.',
            'zip_code.max'            => 'Kode pos maksimal 10 karakter.',

            'latitude.string'         => 'Latitude harus berupa teks.',
            'latitude.max'            => 'Latitude maksimal 50 karakter.',

            'longitude.string'        => 'Longitude harus berupa teks.',
            'longitude.max'           => 'Longitude maksimal 50 karakter.',
        ];
    }
}
