<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  use HasFactory;


  protected $fillable = [
    'user_id',
    'total_amount',
    'status',
    'payment_id',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'total_amount' => 'decimal:2',
      'created_at' => 'datetime',
      'updated_at' => 'datetime',
    ];
  }

  /**
   * Relación: Una orden pertenece a un usuario.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Relación: Una orden tiene muchos items.
   */
  public function orderItems()
  {
    return $this->hasMany(OrderItem::class);
  }
}

