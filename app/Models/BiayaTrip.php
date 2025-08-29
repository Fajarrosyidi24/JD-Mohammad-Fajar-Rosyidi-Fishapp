<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BiayaTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'biaya',
        'keterangan',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
