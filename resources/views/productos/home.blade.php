<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Veterinaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(180deg,#fafbfc 0%, #f1f5f9 100%); }
        .page-header { max-width: 1100px; margin: 36px auto; }
        .card-listing { max-width: 1100px; margin: 0 auto 48px; }
        .product-card { transition: transform .12s ease, box-shadow .12s ease; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(18,38,63,.08); }
        .price { font-weight: 600; color: #0d6efd; }
        .stock-badge { font-size: .8rem; }
        @media (max-width: 767px) {
            .table-responsive { display: none; }
        }
        @media (min-width: 768px) {
            .cards-mobile { display: none; }
        }
    </style>
</head>
<body>

<div class="page-header container">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h2 class="mb-0"><i class="bi bi-heart-pulse-fill text-danger"></i> Productos Veterinaria</h2>
            <small class="text-muted">Panel de administración — gestión de inventario</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('appointments.index') }}" class="btn btn-success">
                <i class="bi bi-calendar-heart me-1"></i> Ver Citas
            </a>
            <a href="{{ route('productos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Nuevo producto
            </a>
            <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                <i class="bi bi-box-arrow-left me-1"></i> Cerrar sesión
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <form id="productos-filters" method="GET" action="{{ route('productos.index') }}" class="row g-2">
      <div class="col-md-6 col-sm-8">
        <input name="q" value="{{ request('q') }}" class="form-control" placeholder="Buscar por nombre de producto" aria-label="Buscar productos">
      </div>
      <div class="col-md-2 col-sm-4">
        <select name="sort" class="form-select">
          <option value="">Ordenar</option>
          <option value="precio_asc" {{ request('sort') == 'precio_asc' ? 'selected' : '' }}>Precio ↑</option>
          <option value="precio_desc" {{ request('sort') == 'precio_desc' ? 'selected' : '' }}>Precio ↓</option>
          <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Stock ↓</option>
        </select>
      </div>
      <div class="col-md-4 text-md-end">
        <button class="btn btn-outline-primary me-2" type="submit"><i class="bi bi-search"></i> Buscar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-light">Limpiar</a>
      </div>
    </form>
</div>

<div class="card-listing container">
    <div class="row g-3 cards-mobile">
        @forelse($productos as $producto)
            <div class="col-12">
                <div class="card product-card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1">{{ $producto->nombre }}</h5>
                            <div class="text-muted small">ID: {{ $producto->id }}</div>
                        </div>
                        <div class="text-end">
                            <div class="price mb-1">${{ number_format($producto->precio, 2) }}</div>
                            <span class="badge bg-{{ $producto->stock > 0 ? 'success' : 'secondary' }} stock-badge">{{ $producto->stock }}</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent d-flex justify-content-end gap-2">
                        <a href="{{ route('productos.pdf', $producto->id) }}" class="btn btn-sm btn-outline-danger" target="_blank" rel="noopener" title="Generar PDF"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
                        <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Ver</a>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i> Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')"><i class="bi bi-trash"></i> Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">No hay productos registrados.</div>
            </div>
        @endforelse
    </div>

    <div class="table-responsive mt-3">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th class="text-end">Precio</th>
                    <th class="text-center">Stock</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td class="text-end price">${{ number_format($producto->precio, 2) }}</td>
                        <td class="text-center"><span class="badge bg-{{ $producto->stock > 0 ? 'success' : 'secondary' }}">{{ $producto->stock }}</span></td>
                        <td class="text-end">
                            <a href="{{ route('productos.pdf', $producto->id) }}" class="btn btn-sm btn-outline-danger me-1" title="PDF" target="_blank" rel="noopener"><i class="bi bi-file-earmark-pdf"></i></a>
                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-sm btn-primary me-1" title="Ver"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning me-1" title="Editar"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este producto?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay productos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        @if(method_exists($productos, 'links'))
            <nav aria-label="Paginación" class="d-flex justify-content-center">
                {{ $productos->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
            </nav>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (function(){
        console.log("inicio de filter")
        var sortSelect = document.querySelector('#productos-filters select[name="sort"]');
        console.log(sortSelect);
        if (sortSelect) {
            sortSelect.addEventListener('change', function(){
                document.getElementById('productos-filters').submit();
            });
        }
    })();
</script>
</body>
</html>
