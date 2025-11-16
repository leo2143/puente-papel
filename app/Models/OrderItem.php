<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
  use HasFactory;


  protected $fillable = [
    'order_id',
    'product_id',
    'quantity',
    'price',
  ];


  protected function casts(): array
  {
    return [
      'quantity' => 'integer',
      'price' => 'decimal:2',
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];
  }

  /**
   * Relación: Un item pertenece a una orden.
   */
  public function order()
  {
    return $this->belongsTo(Order::class);
  }

  /**
   * Relación: Un item pertenece a un producto.
   */
  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}

