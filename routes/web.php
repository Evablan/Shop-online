<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});




//Rutas públicas (sin autenticación)
Route::get('login', [AuthController::class, 'showLogin'])->name('login'); //Para mostrar el form
Route::post('login', [AuthController::class, 'login'])->name('login'); //Para procesar el form
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register');

// Rutas del carrito  (protegidas por autenticación)
Route::middleware('auth')->group(function(){
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Rutas de productos (protegidas por autenticación)
Route::middleware('auth')->group(function(){
Route::resource('products', ProductController::class); //products es el nombre de la ruta y ProductController es el controlador que se encarga de manejar las peticiones
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');//{id} es un parámetro que se pasa a la función show
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

});

//Rutas de ordenes (protegidas por autenticación)
Route::middleware('auth')->group(function(){
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');//Muestra las ordenes del usuario autenticado
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');//Muestra una orden específica
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');//Crea una orden
});