<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aktiitas extends Model
{
   use HasFactory;

    protected $fillable = [
        'trip_id',
        'day',
        'start_time',
        'end_time',
        'kegiatan',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
