<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Producto {{ $producto->id }} - PDF</title>
	<style>
		/* Minimal, print-friendly styles suitable for DOMPDF */
		body { font-family: DejaVu Sans, Arial, sans-serif; color: #111; margin: 24px; }
		.header { display:flex; align-items:center; gap:16px; margin-bottom:24px }
		.logo { width:64px; height:64px; display:flex; align-items:center; justify-content:center; background:#f1f5f9; border-radius:8px }
		h1 { font-size:20px; margin:0 }
		.meta { color:#555; font-size:12px }
		.section { margin-top:16px }
		table { width:100%; border-collapse:collapse; margin-top:8px }
		th, td { padding:8px 6px; border:1px solid #ddd; text-align:left }
		.label { width:160px; font-weight:600; background:#fafafa }
		.price { color:#0d6efd; font-weight:700 }
		.stock { display:inline-block; padding:4px 8px; border-radius:6px; color:#fff }
		.stock.in { background:#198754 }
		.stock.out { background:#6c757d }
		.footer { margin-top:28px; font-size:12px; color:#666 }
		@media print { .no-print { display:none } }
	</style>
</head>
<body>

	<div class="header">
		<div>
			<h1>Detalle de producto — {{ $producto->nombre }}</h1>
			<div class="meta">ID: {{ $producto->id }} • Generado: {{ now()->format('d/m/Y H:i') }}</div>
		</div>
	</div>

	<div class="section">
		<table>
			<tr>
				<th class="label">Nombre</th>
				<td>{{ $producto->nombre }}</td>
			</tr>
			<tr>
				<th class="label">Precio</th>
				<td class="price">${{ number_format($producto->precio, 2) }}</td>
			</tr>
			<tr>
				<th class="label">Stock</th>
				<td>
					@if($producto->stock > 0)
						<span class="stock in">{{ $producto->stock }} disponibles</span>
					@else
						<span class="stock out">Agotado</span>
					@endif
				</td>
			</tr>
			<tr>
				<th class="label">Creado</th>
				<td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
			</tr>
			<tr>
				<th class="label">Última actualización</th>
				<td>{{ $producto->updated_at->format('d/m/Y H:i') }}</td>
			</tr>
		</table>
	</div>

	@if(!empty($producto->descripcion))
		<div class="section">
			<h3>Descripción</h3>
			<div>{{ $producto->descripcion }}</div>
		</div>
	@endif

	<div class="footer no-print">Comprobante del producto.</div>

</body>
</html>

