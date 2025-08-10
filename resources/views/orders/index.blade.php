@extends('layouts.app')

@section('title', 'Ordenes')

@section('content')

<div class="container">
    <h1>Mis pedidos</h1>
    @if($orders->count() > 0)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                            Ver Detalles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@else
<div class="alert alert-info">
    <h4>No tienes pedidos</h4>
    <p>Comienza agregando productos a tu carrito y creando un pedido.</p>
    <a href="{{ route('products.index') }}" class="btn btn-primary">Ver productos</a>
</div>
@endif

@endsection
