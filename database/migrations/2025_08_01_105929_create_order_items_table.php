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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); //id del item
            $table->foreignId('order_id')->constrained('orders'); //id de la orden
            $table->foreignId('product_id')->constrained('products'); //id del producto
            $table->integer('quantity'); //cantidad
            $table->decimal('price', 10, 2); //precio
            $table->timestamps(); //fecha de creacion y actualizacion
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
