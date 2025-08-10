@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-shopping-cart me-3"></i>Carrito de Compras
                    </h4>
                </div>
                <div class="card-body p-5">
                    @if($cartItems->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Precio</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                                             alt="{{ $item->product->name }}" 
                                                             class="rounded me-3"
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                             style="width: 60px; height: 60px;">
                                                            <i class="fas fa-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                        <small class="text-muted">
                                                            {{ $item->product->aroma }} • {{ $item->product->size }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="fw-bold text-primary">${{ number_format($item->price, 2) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="input-group input-group-sm" style="width: 120px;">
                                                        <button type="button" class="btn btn-outline-secondary btn-decrease" 
                                                                data-item-id="{{ $item->id }}" 
                                                                data-current-qty="{{ $item->quantity }}">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                        <input type="number" 
                                                               name="quantity" 
                                                               value="{{ $item->quantity }}" 
                                                               min="1" 
                                                               max="10" 
                                                               class="form-control text-center quantity-input"
                                                               data-item-id="{{ $item->id }}">
                                                        <button type="button" class="btn btn-outline-secondary btn-increase" 
                                                                data-item-id="{{ $item->id }}" 
                                                                data-current-qty="{{ $item->quantity }}">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <span class="fw-bold text-success">${{ number_format($item->subtotal, 2) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" 
                                                            onclick="return confirm('¿Eliminar este producto del carrito?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Resumen del carrito -->
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-secondary" 
                                            onclick="return confirm('¿Vaciar todo el carrito?')">
                                        <i class="fas fa-trash me-2"></i>Vaciar Carrito
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Total:</h5>
                                            <h4 class="mb-0 text-primary">${{ number_format($total, 2) }}</h4>
                                        </div>
                                        <hr>
                                        
                                        <button class="btn btn-primary btn-lg w-100" disabled>
                                            <i class="fas fa-credit-card me-2"></i>Proceder al Pago
                                        </button>
                                        <div class="my-3"></div>
                                        <form action = "{{ route('orders.store') }}" method = "POST">
                                        <input type = "text" name = "shipping_address" placeholder = "Dirección de envío" class = "form-control mb-3"required>
                                        <button type = "submit" class = "btn btn-primary btn-lg w-100">Crear Pedido</button>
                                        
                                        <small class="text-muted d-block text-center mt-2">
                                            Funcionalidad de pago en desarrollo
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Carrito vacío -->
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
                            <h3 class="text-muted mb-3">Tu carrito está vacío</h3>
                            <p class="text-muted mb-4">Agrega algunos productos para comenzar a comprar.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-shopping-bag me-2"></i>Ver Productos
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Botones de incremento/decremento
    document.querySelectorAll('.btn-increase').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            const input = document.querySelector(`input[data-item-id="${itemId}"]`);
            const currentQty = parseInt(input.value);
            if (currentQty < 10) {
                input.value = currentQty + 1;
                updateQuantity(itemId, currentQty + 1);
            }
        });
    });

    document.querySelectorAll('.btn-decrease').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.itemId;
            const input = document.querySelector(`input[data-item-id="${itemId}"]`);
            const currentQty = parseInt(input.value);
            if (currentQty > 1) {
                input.value = currentQty - 1;
                updateQuantity(itemId, currentQty - 1);
            }
        });
    });

    // Actualizar cantidad cuando cambia el input
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const itemId = this.dataset.itemId;
            const quantity = parseInt(this.value);
            if (quantity >= 1 && quantity <= 10) {
                updateQuantity(itemId, quantity);
            }
        });
    });

    function updateQuantity(itemId, quantity) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/cart/update/${itemId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PUT';
        
        const quantityField = document.createElement('input');
        quantityField.type = 'hidden';
        quantityField.name = 'quantity';
        quantityField.value = quantity;
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        form.appendChild(quantityField);
        
        document.body.appendChild(form);
        form.submit();
    }
});
</script>
@endpush
@endsection 