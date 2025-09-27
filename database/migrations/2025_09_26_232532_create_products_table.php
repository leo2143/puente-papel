<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('author')->nullable();
            $table->string('language')->nullable();
            $table->string('publisher')->nullable();
            $table->string('category');
            $table->string('image')->nullable();
            $table->text('images')->nullable(); // Para JSON de múltiples imágenes
            $table->string('image_path')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};