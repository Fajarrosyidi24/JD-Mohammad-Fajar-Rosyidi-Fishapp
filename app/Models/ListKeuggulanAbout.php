<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListKeuggulanAbout extends Model
{
    use HasFactory;

    protected $table = 'list_keunggulan_abouts'; 
    protected $fillable = [
        'about_id',
        'title',
    ];

    public function about()
    {
        return $this->belongsTo(About::class, 'about_id');
    }
}
