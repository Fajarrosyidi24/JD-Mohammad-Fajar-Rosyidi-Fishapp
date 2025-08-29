<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;
    protected $fillable = ['namaPaket', 'jenisPaket', 'deskripsi', 'image', 'status', 'durasi', 'destinasi_id'];
    protected $appends = ['image_url'];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destinasi_id');
    }
    
    public function detail()
    {
        return $this->hasOne(DetailTrip::class);
    }

    public function activities()
    {
        return $this->hasMany(Aktiitas::class);
    }

    public function biayaTrips()
    {
        return $this->hasMany(BiayaTrip::class);
    }
}
