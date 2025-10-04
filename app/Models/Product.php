<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'description',
        'price',
        'author',
        'language',
        'publisher',
        'category',
        'image',
        'stock',
        'is_active',
        'status'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Get the image URL for this product.
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        return ImageService::getUrl($this->image, 'products');
    }
}