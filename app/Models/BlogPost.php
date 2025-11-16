<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class BlogPost extends Model
{
  use HasFactory;

  /**
   * Campos que se pueden asignar masivamente.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'title',
    'slug',
    'content',
    'featured_image',
    'status',
    'user_id'
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'content' => 'string', // Markdown de dile-editor
    ];
  }

  /**
   * Relación belongsTo con User.
   * Se define en el modelo que tiene la FK (tabla referenciante).
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Accessor para obtener la URL de la imagen destacada.
   * Usando Attribute::make() con named arguments (PHP 8+).
   */
  public function featuredImageUrl(): Attribute
  {
    return Attribute::make(
      get: fn ($value, $attributes) => $attributes['featured_image'] 
        ? ImageService::getUrl($attributes['featured_image'], 'blog') 
        : null,
    );
  }

  public function contentHtml(): Attribute
  {
    return Attribute::make(
      get: function () {
        // Si no hay contenido, retornar string vacío
        if (empty($this->content)) {
          return '';
        }

        $converter = new \League\CommonMark\CommonMarkConverter([
          'html_input' => 'strip',         // Elimina HTML peligroso
          'allow_unsafe_links' => false,   // Bloquea enlaces inseguros
        ]);

        return $converter->convert($this->content)->getContent();
      }
    );
  }
  
}
