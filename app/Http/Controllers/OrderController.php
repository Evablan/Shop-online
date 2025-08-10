<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){ //muestra las ordenes del usuario autenticado
        $orders = Order::where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'desc') //ordena las ordenes por fecha de creación
        ->get(); //obtiene las ordenes del usuario autenticado
        return view('orders.index', compact('orders')); //muestra las ordenes
    }

    public function show($id){
        $order = Order::where('user_id', Auth::user()->id)->findOrFail($id); //busca la orden por id
        return view('orders.show', compact('order')); //muestra la orden
    }

    public function store(Request $request){
        $sessionId = session()->getId(); //obtiene el id de la sesion
        $cartItems = CartItem::where('session_id', $sessionId)->get(); //obtiene los items del carrito

        if($cartItems->isEmpty()){ //si el carrito está vacío, redirige a la página de productos
            return redirect()->route('products.index')->with('error', 'El carrito está vacío');
        }

        $order = new Order();
        $order->user_id = Auth::user()->id; //id del usuario
        $order->total = $cartItems->sum(function($item){ //suma el precio de los items
            return $item->price * $item->quantity; //precio del item * cantidad del item
        });
        $order->status = 'pending'; //estado de la orden
        $order->shipping_address = $request->shipping_address; //direccion de envio
        $order->save(); //guarda la orden

        foreach($cartItems as $item){
            $orderItem = new OrderItem(); //crea un nuevo item de orden
            $orderItem->order_id = $order->id; //id de la orden
            $orderItem->product_id = $item->product_id; //id del producto
            $orderItem->quantity = $item->quantity; //cantidad
            $orderItem->price = $item->price; //precio
            $orderItem->save(); //guarda el item de orden
        }

        CartItem::where('session_id', $sessionId)->delete(); //elimina los items del carrito

        return redirect()->route('orders.show', $order->id )->with('success', 'Orden creada correctamente');  
          
    }
}
