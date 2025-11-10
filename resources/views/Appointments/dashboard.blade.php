<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Citas Veterinarias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(180deg, #e8f5e9 0%, #f1f8e9 100%); 
            min-height: 100vh;
            padding: 20px 0;
        }
        .dashboard-header { 
            max-width: 1400px; 
            margin: 20px auto 30px; 
        }
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            height: 100%;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 16px;
        }
        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 8px 0;
        }
        .stats-label {
            color: #6c757d;
            font-size: 0.95rem;
            font-weight: 500;
        }
        .bg-success-light { background: linear-gradient(135deg, #28a745 0%, #20c997 100%); }
        .bg-warning-light { background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%); }
        .bg-danger-light { background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); }
        .bg-info-light { background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); }
        .bg-primary-light { background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); }
        
        .quick-actions {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-top: 24px;
        }
        .quick-action-btn {
            padding: 16px;
            border-radius: 10px;
            border: 2px dashed #dee2e6;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            color: #495057;
        }
        .quick-action-btn:hover {
            border-color: #28a745;
            background: #f8f9fa;
            color: #28a745;
            transform: translateY(-3px);
        }
        .quick-action-icon {
            font-size: 2rem;
            margin-bottom: 8px;
        }
        .recent-appointments {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            margin-top: 24px;
        }
        .appointment-item {
            padding: 16px;
            border-left: 4px solid #28a745;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 12px;
            transition: all 0.2s ease;
        }
        .appointment-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }
        .appointment-item.warning {
            border-left-color: #ffc107;
        }
        .appointment-item.danger {
            border-left-color: #dc3545;
        }
        .appointment-item.info {
            border-left-color: #17a2b8;
        }
    </style>
</head>
<body>

<div class="dashboard-header container">
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap">
        <div>
            <h2 class="mb-0">
                <i class="bi bi-speedometer2 text-success"></i> Dashboard de Citas
            </h2>
            <small class="text-muted">Panel de control y estadísticas</small>
        </div>

        <div class="d-flex gap-2 mt-3 mt-md-0">
            <a href="{{ route('appointments.index') }}" class="btn btn-outline-success">
                <i class="bi bi-calendar-heart me-1"></i> Ver Citas
            </a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('productos.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-box-seam me-1"></i> Productos
                </a>
            @endif
            <a href="{{ route('login.form') }}" class="btn btn-outline-secondary">
                <i class="bi bi-box-arrow-left me-1"></i> Cerrar Sesión
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<div class="dashboard-container container">
    <!-- Estadísticas -->
    <div class="row g-3 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="stats-card">
                <div class="stats-icon bg-success-light text-white">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="stats-number text-success">{{ $totalCitas }}</div>
                <div class="stats-label">Total de Citas</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stats-card">
                <div class="stats-icon bg-warning-light text-white">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stats-number text-warning">{{ $citasPendientes }}</div>
                <div class="stats-label">Citas Pendientes</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stats-card">
                <div class="stats-icon bg-info-light text-white">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stats-number text-info">{{ $citasConfirmadas }}</div>
                <div class="stats-label">Citas Confirmadas</div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="stats-card">
                <div class="stats-icon bg-primary-light text-white">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <div class="stats-number text-primary">{{ $citasHoy }}</div>
                <div class="stats-label">Citas de Hoy</div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="quick-actions">
        <h5 class="mb-3"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>Acciones Rápidas</h5>
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <a href="{{ route('appointments.create') }}" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="bi bi-plus-circle text-success"></i>
                    </div>
                    <div><strong>Nueva Cita</strong></div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('appointments.index') }}" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="bi bi-list-ul text-primary"></i>
                    </div>
                    <div><strong>Ver Todas</strong></div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('productos.index') }}" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="bi bi-box-seam text-info"></i>
                    </div>
                    <div><strong>Productos</strong></div>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('productos.create') }}" class="quick-action-btn">
                    <div class="quick-action-icon">
                        <i class="bi bi-plus-square text-secondary"></i>
                    </div>
                    <div><strong>Nuevo Producto</strong></div>
                </a>
            </div>
        </div>
    </div>

    <!-- Citas Próximas -->
    <div class="recent-appointments">
        <h5 class="mb-3">
            <i class="bi bi-calendar-range text-success me-2"></i>
            Próximas Citas ({{ $proximasCitas->count() }})
        </h5>

        @if($proximasCitas->count() > 0)
            @foreach($proximasCitas as $cita)
                <div class="appointment-item {{ 
                    $cita->estado == 'pendiente' ? 'warning' : 
                    ($cita->estado == 'confirmada' ? 'info' : '') 
                }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="mb-1">
                                <i class="bi bi-person-circle me-2"></i>
                                {{ $cita->nombre_dueno }}
                            </h6>
                            <div class="small text-muted">
                                <i class="bi bi-heart-pulse me-1"></i>
                                Mascota: <strong>{{ $cita->nombre_mascota }}</strong> ({{ $cita->tipo_mascota_formateado }})
                            </div>
                            <div class="small text-muted mt-1">
                                <i class="bi bi-clipboard2-pulse me-1"></i>
                                {{ $cita->servicio_formateado }}
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="badge bg-{{ $cita->estado_badge_color }} mb-2">
                                {{ ucfirst($cita->estado) }}
                            </div>
                            <div class="small">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                            </div>
                            <div class="small">
                                <i class="bi bi-clock me-1"></i>
                                {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="text-center mt-3">
                <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-success">
                    Ver todas las citas <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        @else
            <div class="text-center py-5 text-muted">
                <i class="bi bi-calendar-x" style="font-size: 3rem;"></i>
                <p class="mt-3">No hay citas próximas programadas</p>
                <a href="{{ route('appointments.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Crear Primera Cita
                </a>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
