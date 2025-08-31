<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourierService extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'active', 'courier_id'];

    public function courier()
    {
    return $this->belongsTo(Courier::class);
    }
}
