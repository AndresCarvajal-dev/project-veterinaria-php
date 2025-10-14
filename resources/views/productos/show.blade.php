<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%); }
        .card-show { max-width: 900px; margin: 48px auto; box-shadow: 0 6px 24px rgba(20,30,60,0.06); }
        .rounded-thumb { width:96px; height:96px; object-fit:cover; }
    </style>
</head>
<body>

<div class="card card-show">
    <div class="card-body">
        <div class="d-flex align-items-start gap-3">
            <figure class="flex-shrink-0 mb-0">
                @if(!empty($producto->image))
                    <img src="{{ asset($producto->image) }}" alt="Imagen de {{ $producto->nombre }}" class="rounded-3 rounded-thumb">
                @else
                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center rounded-thumb">
                        <i class="bi bi-box-seam fs-2 text-primary" aria-hidden="true"></i>
                    </div>
                @endif
            </figure>

            <div class="flex-grow-1">
                <h3 class="mb-1">{{ $producto->nombre }}</h3>
                <div class="text-muted mb-2">ID: <span class="fw-semibold">{{ $producto->id }}</span></div>

                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <div>
                        <div class="small text-muted">Precio</div>
                        <div class="h5 mb-0 text-primary">${{ number_format($producto->precio, 2) }}</div>
                    </div>

                    <div>
                        <div class="small text-muted">Stock</div>
                        <span class="badge bg-{{ $producto->stock > 0 ? 'success' : 'secondary' }}">{{ $producto->stock }}</span>
                    </div>
                </div>

                <p class="mt-3 text-muted small mb-0">Creado: {{ $producto->created_at->format('d/m/Y H:i') }} • Actualizado: {{ $producto->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="card-footer bg-white d-flex justify-content-between">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary" aria-label="Volver al inicio">
            <i class="bi bi-arrow-left"></i> Volver
        </a>

        <div>
            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning me-2" aria-label="Editar producto"><i class="bi bi-pencil"></i> Editar</a>

            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" aria-label="Eliminar producto"><i class="bi bi-trash"></i> Eliminar</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
