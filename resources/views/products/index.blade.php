@extends('layouts.app')

@section('title', 'Lista de Productos')

@section('content')
<div class="fade-in-up">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h1 class="h2 mb-1 fw-bold text-primary">
                        <i class="fas fa-box me-3"></i>Productos
                    </h1>
                    <p class="text-muted mb-0">Gestiona tu catálogo de productos</p>
                </div>
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Nuevo Producto
                </a>
                
            </div>

            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-6 col-lg-4">
                            <div class="product-card h-100">
                                <!-- Product Image -->
                                <div class="position-relative">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="product-image">
                                    @else
                                        <div class="product-image-placeholder">
                                            <i class="fas fa-image fa-2x mb-2"></i>
                                            <div>Sin imagen</div>
                                        </div>
                                    @endif
                                    <!-- Price Badge -->
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-primary fs-6 px-3 py-2">
                                            <i class="fas fa-tag me-1"></i>${{ number_format($product->price, 2) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="p-4">
                                    <h5 class="card-title fw-bold mb-3 text-primary">{{ $product->name }}</h5>
                                    
                                    <div class="row g-2 mb-3">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-leaf text-success me-2"></i>
                                                <small class="text-muted">{{ $product->aroma }}</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-palette text-info me-2"></i>
                                                <small class="text-muted">{{ $product->colour }}</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-ruler-combined text-warning me-2"></i>
                                                <small class="text-muted">{{ $product->size }}</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-cube text-secondary me-2"></i>
                                                <small class="text-muted">{{ $product->material }}</small>
                                            </div>
                                        </div>
                                    </div>

                                    @if($product->description)
                                        <p class="card-text text-muted small mb-3">
                                            {{ Str::limit($product->description, 80) }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="p-4 pt-0">
                                                                    <div class="d-grid gap-2">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('products.show', $product->id) }}" 
                                           class="btn btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>Ver
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" 
                                           class="btn btn-outline-warning">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" 
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')">
                                                <i class="fas fa-trash me-1"></i>Eliminar
                                            </button>
                                        </form>
                                    </div>
                                    
                                    <!-- Botón Agregar al Carrito -->
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="fas fa-cart-plus me-1"></i>Agregar al Carrito
                                        </button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5 fade-in-up">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body py-5">
                            <i class="fas fa-box-open fa-4x text-muted mb-4"></i>
                            <h3 class="text-muted mb-3">No hay productos</h3>
                            <p class="text-muted mb-4">Comienza agregando tu primer producto para construir tu catálogo.</p>
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Crear Producto
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection