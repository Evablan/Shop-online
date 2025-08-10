@extends('layouts.app')

@section('title', 'Crear Producto')

@section('content')
<div class="fade-in-up">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-3"></i>Crear Nuevo Producto
                    </h4>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-4">
                            <!-- Nombre del Producto -->
                            <div class="col-12">
                                <label for="name" class="form-label">
                                    <i class="fas fa-tag me-2 text-primary"></i>Nombre del Producto
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Ej: Vela Aromática de Lavanda"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Aroma y Color -->
                            <div class="col-md-6">
                                <label for="aroma" class="form-label">
                                    <i class="fas fa-leaf me-2 text-success"></i>Aroma
                                </label>
                                <textarea class="form-control @error('aroma') is-invalid @enderror" 
                                          id="aroma" 
                                          name="aroma" 
                                          rows="2"
                                          placeholder="Ej: Lavanda, Vainilla, Eucalipto">{{ old('aroma') }}</textarea>
                                @error('aroma')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="colour" class="form-label">
                                    <i class="fas fa-palette me-2 text-info"></i>Color
                                </label>
                                <textarea class="form-control @error('colour') is-invalid @enderror" 
                                          id="colour" 
                                          name="colour" 
                                          rows="2"
                                          placeholder="Ej: Púrpura, Marrón, Verde">{{ old('colour') }}</textarea>
                                @error('colour')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Tamaño y Material -->
                            <div class="col-md-6">
                                <label for="size" class="form-label">
                                    <i class="fas fa-ruler-combined me-2 text-warning"></i>Tamaño
                                </label>
                                <select class="form-select form-select-lg @error('size') is-invalid @enderror" 
                                        id="size" 
                                        name="size" 
                                        required>
                                    <option value="">Selecciona un tamaño</option>
                                    <option value="Pequeña" {{ old('size') == 'Pequeña' ? 'selected' : '' }}>Pequeña</option>
                                    <option value="Mediana" {{ old('size') == 'Mediana' ? 'selected' : '' }}>Mediana</option>
                                    <option value="Grande" {{ old('size') == 'Grande' ? 'selected' : '' }}>Grande</option>
                                </select>
                                @error('size')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="material" class="form-label">
                                    <i class="fas fa-cube me-2 text-secondary"></i>Material
                                </label>
                                <select class="form-select form-select-lg @error('material') is-invalid @enderror" 
                                        id="material" 
                                        name="material" 
                                        required>
                                    <option value="">Selecciona un material</option>
                                    <option value="Cera de soja" {{ old('material') == 'Cera de soja' ? 'selected' : '' }}>Cera de soja</option>
                                    <option value="Cera de abeja" {{ old('material') == 'Cera de abeja' ? 'selected' : '' }}>Cera de abeja</option>
                                    <option value="Parafina" {{ old('material') == 'Parafina' ? 'selected' : '' }}>Parafina</option>
                                </select>
                                @error('material')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div class="col-12">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left me-2 text-primary"></i>Descripción
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="4"
                                          placeholder="Describe las características y beneficios de tu producto...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Precio -->
                            <div class="col-md-6">
                                <label for="price" class="form-label">
                                    <i class="fas fa-dollar-sign me-2 text-success"></i>Precio
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-tag text-muted"></i>
                                    </span>
                                    <input type="number" 
                                           class="form-control border-start-0 @error('price') is-invalid @enderror" 
                                           id="price" 
                                           name="price" 
                                           value="{{ old('price') }}" 
                                           step="0.01" 
                                           min="0" 
                                           placeholder="0.00"
                                           required>
                                    @error('price')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Imagen -->
                            <div class="col-md-6">
                                <label for="image" class="form-label">
                                    <i class="fas fa-image me-2 text-info"></i>Imagen del Producto
                                </label>
                                <input type="file" 
                                       class="form-control @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>Formatos permitidos: JPG, PNG, GIF. Máximo 2MB.
                                </div>
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Volver
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Crear Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection