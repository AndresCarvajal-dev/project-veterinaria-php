<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%); }
        .card-edit { max-width: 720px; margin: 48px auto; box-shadow: 0 6px 24px rgba(20,30,60,0.08); }
        .form-icon { width: 40px; text-align: center; color: #6c757d; }
        .input-group .form-control:focus { box-shadow: none; border-color: #86b7fe; }
        .help-block { font-size: 0.875rem; color: #6c757d; }
    </style>
</head>
<body>

<div class="card card-edit">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <div class="me-3">
                <span class="badge bg-warning rounded-circle p-3"><i class="bi bi-pencil-square text-white fs-4"></i></span>
            </div>
            <div>
                <h4 class="card-title mb-0">Editar Producto</h4>
                <small class="text-muted">Modifica los datos del producto</small>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Corrige los siguientes errores:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('productos.update', $producto->id) }}" method="POST" novalidate>
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del producto</label>
                <div class="input-group">
                    <span class="input-group-text form-icon"><i class="bi bi-pencil"></i></span>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $producto->nombre) }}" required>
                </div> 
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <div class="help-block">Ejemplo: Cepillo dental para mascotas</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="precio" class="form-label">Precio ($)</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" name="precio" id="precio" class="form-control @error('precio') is-invalid @enderror" step="0.01" value="{{ old('precio', $producto->precio) }}" required>
                    </div>
                    @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Cantidad en stock</label>
                    <div class="input-group">
                        <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $producto->stock) }}" required>
                    </div>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Volver
                </a>

                <div>
                    <a href="{{ route('productos.index') }}" class="btn btn-light me-2">Cancelar</a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save me-1"></i> Actualizar producto
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
