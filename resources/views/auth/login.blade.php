@extends('layouts.app')
@section('title', 'Iniciar sesión')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Iniciar sesión</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type = "submit" class="btn btn-primary">Iniciar sesión</button>
                    </form>

                    <div class = "text-center mt-4">
                        <p class = "text-muted">¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
