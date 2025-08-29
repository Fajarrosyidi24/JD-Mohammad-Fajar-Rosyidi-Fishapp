<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTrip extends Model
{
    use HasFactory;
     protected $fillable = [
        'trip_id',
        'deskripsi',
        'brosur',
        'info_tambahan'
    ];

    protected $appends = ['brosur_url'];
    public function getBrosurUrlAttribute(): ?string
    {
        return $this->brosur ? Storage::url($this->brosur) : null;
    }

     public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
