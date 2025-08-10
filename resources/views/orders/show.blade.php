@extends('layouts.app')

@section('title', 'Detalle de pedido')

@section('content')

<div class="container">
    <h1>Detalle del pedido</h1>
    <div class = "card">
        <div class = "card-body">
            <h5 class="card-title">Pedido #{{ $order->id }}</h5>
            <h5 class = "card-text">Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</h5>
            <h5 class = "card-text">Total: ${{ number_format($order->total, 2) }}</h5>
            <h5 class = "card-text">Estado: {{ $order->status }}</h5>
            <h5 class = "card-text">Dirección de envío: {{ $order->shipping_address }}</h5>
            <h5 class = "card-text">Productos:</h5>
            <ul class = "list-group">
                @foreach($order->items as $item)
                    <li class = "list-group-item">
                        {{ $item->product->name }} - ${{ number_format($item->price, 2) }} x {{ $item->quantity }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="mt-4">
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Volver a mis pedidos
    </a>
    <a href="{{ route('products.index') }}" class="btn btn-primary">
        <i class="fas fa-shopping-bag me-2"></i>Seguir comprando
    </a>
</div>

@endsection


   