<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'images',
        'image_path',
        'stock',
        'is_active',
        'user_id'
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
