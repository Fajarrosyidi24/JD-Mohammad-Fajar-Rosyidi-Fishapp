<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'country_code',
        'phone',
        'country',
        'address',
        'state',
        'province_id',
        'city',
        'city_id',
        'subdistrict',
        'subdistrict_id',
        'vilage',
        'vilage_id',
        'zip_code',
        'latitude',
        'longitude',
        'user_id',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
