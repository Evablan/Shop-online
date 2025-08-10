<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $fillable = ['session_id', 'product_id', 'quantity', 'price'];

   public function product()
   {
    return $this->belongsTo(Product::class);
   }

   public static function getCartTotal($sessionId)
   {
    return self::where('session_id', $sessionId)
               ->sum(\DB::raw('quantity * price'));
    }
    public static function getCartCount($sessionId)
    {
        return self::where('session_id', $sessionId)->count();
    }
}