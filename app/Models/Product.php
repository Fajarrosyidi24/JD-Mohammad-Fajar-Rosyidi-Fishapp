<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Enums\CropPosition;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = "products";

    protected $fillable = [
        'product_category_id',
        'user_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'status',
    ];

    protected $casts = [
        'id'                  => 'integer',
        'user_id'             => 'integer',
        'name'                => 'string',
        'slug'                => 'string',
        'description'         => 'string',
        'price'               => 'decimal:2',
        'stock'               => 'integer',
        'status'              => 'integer',
    ];

    protected $appends = array('cover');

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->crop(200, 200, CropPosition::Center)
            ->keepOriginalImageFormat()
            ->sharpen(10);

        $this->addMediaConversion('cover')
            ->crop(800, 800, CropPosition::Center)
            ->keepOriginalImageFormat()
            ->sharpen(10);
    }

    public function getThumbAttribute(): string
    {
        if (!empty($this->getFirstMediaUrl('product'))) {
            $media = $this->getMedia('product')->last();
            return $media->getUrl('thumb');
        }
        return asset('images/default/product/thumb.png');
    }

    public function getCoverAttribute(): string
    {
        if (!empty($this->getFirstMediaUrl('product'))) {
            $media = $this->getMedia('product')->last();
            return $media->getUrl('cover');
        }
        return asset('images/default/product/cover.png');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', Status::ACTIVE);
    }
}
