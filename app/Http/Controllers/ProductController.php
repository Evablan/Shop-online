<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index() //muestra todos los productos
    {
        //Obtener todos los productos de la base de datos
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    
    public function create() //muestra el formulario para crear un nuevo producto
    {
        return view('products.create');
    }

    
    public function store(Request $request) //guarda el nuevo producto en la base de datos
    {
        $request->validate([
            'name' => 'required',
        'aroma' => 'required',
        'colour' => 'required',
        'size' => 'required',
        'material' => 'required',
        'description' => 'nullable',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->aroma = $request->aroma;
        $product->colour = $request->colour;
        $product->size = $request->size;
        $product->material = $request->material;
        $product->description = $request->description;
        $product->price = $request->price;

        if($request->hasFile('image')){
            $product->image = $request->file('image')->store('products', 'public'); 
        }

        $product->save();
        return redirect()->route('products.index');

    }
    

    
    public function show(string $id) //muestra un producto específico
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

   
    public function edit(string $id) //muestra el formulario para editar un producto específico
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

   
    public function update(Request $request, string $id) //actualiza un producto específico
    {
        $request->validate([
            'name' => 'required',
            'aroma' => 'required',
            'colour' => 'required',
            'size' => 'required',
            'material' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->aroma = $request->aroma;
        $product->colour = $request->colour;
        $product->size = $request->size;
        $product->material = $request->material;
        $product->description = $request->description;
        $product->price = $request->price;
        
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }
    
        $product->save();
        return redirect()->route('products.index');


    }

   
    public function destroy(string $id) //elimina un producto específico
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index');
    }
}
