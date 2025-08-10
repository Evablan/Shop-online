<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('aroma');
            $table->string('colour');
            $table->string('size');
            $table->string('material');
            $table->text('description')->nullable();//nullable porque no todos los productos tienen descripcion
            $table->decimal('price', 10, 2); 
            $table->string('image')->nullable(); //nullable porque no todos los productos tienen imagen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
