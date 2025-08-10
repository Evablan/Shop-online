<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Mostrar el carrito
     */
    public function index()
    {
        $sessionId = session()->getId(); //obtiene el id de la sesion
        $cartItems = CartItem::where('session_id', $sessionId)
                            ->with('product')
                            ->get();
        
        $total = CartItem::getCartTotal($sessionId); //obtiene el total del carrito
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Agregar producto al carrito
     */
    public function add(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $product = Product::findOrFail($productId); //busca el producto por id
        $sessionId = session()->getId(); //obtiene el id de la sesion

        // Verificar si el producto ya está en el carrito
        $cartItem = CartItem::where('session_id', $sessionId) //busca el item por id de sesion
                           ->where('product_id', $productId) //busca el item por id de producto
                           ->first(); //obtiene el primer item

        if ($cartItem) {
            // Actualizar cantidad si ya existe
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity //actualiza la cantidad
            ]);
        } else {
            // Crear nuevo item en el carrito
            CartItem::create([
                'session_id' => $sessionId, //id de la sesion
                'product_id' => $productId, //id del producto
                'quantity' => $request->quantity, //cantidad
                'price' => $product->price //precio
            ]);
        }

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    /**
     * Actualizar cantidad de un item
     */
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $cartItem = CartItem::findOrFail($itemId); //busca el item por id
        $sessionId = session()->getId(); //obtiene el id de la sesion

        // Verificar que el item pertenece a la sesión actual
        if ($cartItem->session_id !== $sessionId) {
            return redirect()->back()->with('error', 'Acceso no autorizado');
        }

        $cartItem->update(['quantity' => $request->quantity]); //actualiza la cantidad

        return redirect()->back()->with('success', 'Cantidad actualizada');
    }

    /**
     * Eliminar item del carrito
     */
    public function remove($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId); //busca el item por id
        $sessionId = session()->getId(); //obtiene el id de la sesion

        // Verificar que el item pertenece a la sesión actual
        if ($cartItem->session_id !== $sessionId) {
            return redirect()->back()->with('error', 'Acceso no autorizado');
        }

        $cartItem->delete(); //elimina el item

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    /**
     * Vaciar el carrito
     */
    public function clear()
    {
        $sessionId = session()->getId(); //obtiene el id de la sesion
        CartItem::where('session_id', $sessionId)->delete(); //elimina todos los items de la sesion

        return redirect()->back()->with('success', 'Carrito vaciado');
    }
} 