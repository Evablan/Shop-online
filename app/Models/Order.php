<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total', 'status', 'shipping_address'];

    public function user()
    {
        return $this->belongsTo(User::class); //un usuario puede tener muchas ordenes
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class); //una orden puede tener muchos items
    }

    public function getTotalAttribute()
    {
        return $this->items->sum(function($item){ //suma el precio de los items
            return $item->price * $item->quantity; //precio del item * cantidad del item
        });
    }

    
    
    
}
