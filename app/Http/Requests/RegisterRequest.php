<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class RegisterRequest extends FormRequest
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
        $today = Carbon::today();
        $minBirthDate = $today->copy()->subYears(17)->format('Y-m-d');

        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date', "before_or_equal:$minBirthDate"],
            'gender' => ['required'],
            'photo_profile' => ['required', 'image', 'max:20480'],
            'photo_ktp' => ['required', 'image', 'max:20480'],
            'password' => [
                'required',
                'string',
                Password::min(8) // minimal 8 karakter
                    ->mixedCase() // harus ada huruf besar & kecil
                    ->numbers() // harus ada angka
            ],
            'password_confirmation' => ['required', 'string', 'same:password'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email tidak valid.',

            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',

            'address.required' => 'Alamat wajib diisi.',
            'address.string' => 'Alamat harus berupa teks.',
            'address.max' => 'Alamat maksimal 255 karakter.',

            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'birth_date.date' => 'Tanggal lahir tidak valid.',
            'birth_date.before_or_equal' => 'Umur minimal 16 tahun dan tanggal lahir tidak boleh di masa depan.',

            'gender.required' => 'Jenis kelamin wajib dipilih.',

            'photo_profile.required' => 'Foto profil wajib diunggah.',
            'photo_profile.image' => 'Foto profil harus berupa gambar.',
            'photo_profile.max' => 'Ukuran foto profil maksimal 20MB.',

            'photo_ktp.required' => 'Foto KTP wajib diunggah.',
            'photo_ktp.image' => 'Foto KTP harus berupa gambar.',
            'photo_ktp.max' => 'Ukuran foto KTP maksimal 20MB.',

            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.mixedCase' => 'Password harus mengandung huruf besar dan kecil.',
            'password.numbers' => 'Password harus mengandung angka.',

            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.string' => 'Konfirmasi password harus berupa teks.',
            'password_confirmation.same' => 'Konfirmasi password tidak sama dengan password.',
        ];
    }
}
