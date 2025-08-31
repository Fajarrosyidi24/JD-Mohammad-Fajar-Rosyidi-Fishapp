<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'active'];

    public function ekspedisis()
    {
        return $this->hasMany(CourierService::class);
    }
}
