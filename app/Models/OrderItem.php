<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class); //un item pertenece a una orden
    }

    public function product()
    {
        return $this->belongsTo(Product::class); //un item pertenece a un producto
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->quantity; //precio del item * cantidad del item
    }
    
    
}
