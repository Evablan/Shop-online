@extends('layouts.app')

@section('title', $product ? $product->name : 'Producto no encontrado')

@section('content')
<div class="fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-eye me-3"></i>Detalles del Producto
                    </h4>
                </div>
                <div class="card-body p-5">
                    <div class="row g-5">
                        <!-- Imagen del Producto -->
                        @if($product->image)
                            <div class="col-lg-5">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="img-fluid rounded-3 shadow-lg w-100"
                                         style="max-height: 400px; object-fit: cover;">
                                    <!-- Badge de Precio -->
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-primary fs-5 px-4 py-3">
                                            <i class="fas fa-tag me-2"></i>${{ number_format($product->price, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Información del Producto -->
                        <div class="col-lg-{{ $product->image ? '7' : '12' }}">
                            <h1 class="h2 fw-bold text-primary mb-4">{{ $product->name }}</h1>
                            
                            <!-- Características del Producto -->
                            <div class="row g-4 mb-5">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                        <i class="fas fa-leaf fa-2x text-success me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">Aroma</small>
                                            <strong>{{ $product->aroma }}</strong>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                        <i class="fas fa-palette fa-2x text-info me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">Color</small>
                                            <strong>{{ $product->colour }}</strong>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                        <i class="fas fa-ruler-combined fa-2x text-warning me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">Tamaño</small>
                                            <strong>{{ $product->size }}</strong>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                                        <i class="fas fa-cube fa-2x text-secondary me-3"></i>
                                        <div>
                                            <small class="text-muted d-block">Material</small>
                                            <strong>{{ $product->material }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Descripción -->
                            @if($product->description)
                                <div class="mb-5">
                                    <h5 class="text-primary mb-3">
                                        <i class="fas fa-align-left me-2"></i>Descripción
                                    </h5>
                                    <div class="p-4 bg-light rounded-3">
                                        <p class="mb-0">{{ $product->description }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Información Técnica -->
                            <div class="mb-5">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-info-circle me-2"></i>Información Técnica
                                </h5>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="text-center p-3 bg-light rounded-3">
                                            <div class="text-muted small">ID del Producto</div>
                                            <strong class="text-primary">#{{ $product->id }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center p-3 bg-light rounded-3">
                                            <div class="text-muted small">Fecha de Creación</div>
                                            <strong>{{ $product->created_at->format('d/m/Y') }}</strong>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center p-3 bg-light rounded-3">
                                            <div class="text-muted small">Última Actualización</div>
                                            <strong>{{ $product->updated_at->format('d/m/Y') }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botones de Acción -->
                    <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Volver a la Lista
                        </a>
                        <div class="d-flex gap-3">
                            <!-- Botón Agregar al Carrito -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-cart-plus me-2"></i>Agregar al Carrito
                                </button>
                            </form>
                            
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-lg">
                                <i class="fas fa-edit me-2"></i>Editar
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-danger btn-lg" 
                                        onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')">
                                    <i class="fas fa-trash me-2"></i>Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection