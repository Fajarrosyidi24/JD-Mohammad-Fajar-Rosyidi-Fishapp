<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'birth_date',
        'gender',
        'photo_profile',
        'photo_ktp',
    ];
    protected $appends = ['ktp_url', 'profile_photo_url']; 

    public function getKtpUrlAttribute(): ?string
    {
        return $this->photo_ktp ? Storage::url($this->photo_ktp) : null;
    }

    public function getProfilePhotoUrlAttribute(): ?string
    {
        return $this->photo_profile ? Storage::url($this->photo_profile) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
