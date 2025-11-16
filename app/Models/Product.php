<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class Product extends Model
{
  use HasFactory;

  /**
   * Campos que se pueden asignar masivamente.
   *
   * @var array<int, string>
   */
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
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'price' => 'decimal:2',
      'stock' => 'integer',
      'is_active' => 'boolean',
    ];
  }

  /**
   * Accessor para obtener la URL de la imagen.
   * Usando Attribute::make() con named arguments (PHP 8+).
   */
  public function imageUrl(): Attribute
  {
    return Attribute::make(
      get: fn ($value, $attributes) => $attributes['image'] 
        ? ImageService::getUrl($attributes['image'], 'products') 
        : null,
    );
  }

  /**
   * Relación: Un producto tiene muchos items de orden.
   */
  public function orderItems()
  {
    return $this->hasMany(OrderItem::class);
  }
}
