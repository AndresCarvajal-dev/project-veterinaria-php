<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas Veterinarias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(180deg, #e8f5e9 0%, #f1f8e9 100%); 
            min-height: 100vh;
            padding: 20px 0;
        }
        .page-header { 
            max-width: 1200px; 
            margin: 20px auto 30px; 
        }
        .appointments-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .appointment-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.1);
            margin-bottom: 20px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
        }
        .appointment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(46, 125, 50, 0.2);
        }
        .appointment-header {
            background: linear-gradient(135deg, #2e7d32 0%, #43a047 100%);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .appointment-body {
            padding: 20px;
        }
        .badge-status {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .info-row {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f0f0f0;
        }
        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .info-icon {
            color: #2e7d32;
            font-size: 20px;
            margin-right: 12px;
            width: 30px;
            text-align: center;
        }
        .info-label {
            font-weight: 600;
            color: #555;
            margin-right: 8px;
            min-width: 120px;
        }
        .info-value {
            color: #333;
        }
        .btn-action {
            margin: 0 5px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .empty-state i {
            font-size: 80px;
            color: #ccc;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .info-label {
                min-width: 80px;
                font-size: 0.9rem;
            }
            .appointment-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .badge-status {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

<div class="page-header container">
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap">
        <div>
            <h2 class="mb-0">
                <i class="bi bi-calendar-heart-fill text-success"></i> Mis Citas Veterinarias
            </h2>
            <small class="text-muted">Gestiona tus citas programadas</small>
        </div>

        <div class="d-flex gap-2 mt-3 mt-md-0">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-success">
                <i class="bi bi-speedometer2 me-1"></i> Dashboard
            </a>
            <a href="{{ route('appointments.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i> Nueva Cita
            </a>
            <a href="{{ route('productos.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-box-seam me-1"></i> Productos
            </a>
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

<div class="appointments-container container">
    @if($appointments->count() > 0)
        <div class="row">
            @foreach($appointments as $appointment)
                <div class="col-md-6 col-lg-6">
                    <div class="appointment-card">
                        <div class="appointment-header">
                            <div>
                                <h5 class="mb-0">
                                    <i class="bi bi-person-circle me-2"></i>
                                    {{ $appointment->nombre_dueno }}
                                </h5>
                                <small class="opacity-90">
                                    Mascota: {{ $appointment->nombre_mascota }}
                                </small>
                            </div>
                            <span class="badge badge-status bg-{{ $appointment->estado_badge_color }}">
                                {{ ucfirst($appointment->estado) }}
                            </span>
                        </div>

                        <div class="appointment-body">
                            <div class="info-row">
                                <i class="bi bi-calendar3 info-icon"></i>
                                <span class="info-label">Fecha:</span>
                                <span class="info-value">
                                    {{ \Carbon\Carbon::parse($appointment->fecha)->format('d/m/Y') }}
                                </span>
                            </div>

                            <div class="info-row">
                                <i class="bi bi-clock info-icon"></i>
                                <span class="info-label">Hora:</span>
                                <span class="info-value">
                                    {{ \Carbon\Carbon::parse($appointment->hora)->format('h:i A') }}
                                </span>
                            </div>

                            <div class="info-row">
                                <i class="bi bi-heart-pulse info-icon"></i>
                                <span class="info-label">Mascota:</span>
                                <span class="info-value">
                                    {{ $appointment->nombre_mascota }} 
                                    <small class="text-muted">({{ $appointment->tipo_mascota_formateado }})</small>
                                </span>
                            </div>

                            <div class="info-row">
                                <i class="bi bi-clipboard2-pulse info-icon"></i>
                                <span class="info-label">Servicio:</span>
                                <span class="info-value">{{ $appointment->servicio_formateado }}</span>
                            </div>

                            <div class="info-row">
                                <i class="bi bi-telephone info-icon"></i>
                                <span class="info-label">Teléfono:</span>
                                <span class="info-value">{{ $appointment->telefono }}</span>
                            </div>

                            <div class="info-row">
                                <i class="bi bi-envelope info-icon"></i>
                                <span class="info-label">Email:</span>
                                <span class="info-value">{{ $appointment->email }}</span>
                            </div>

                            @if($appointment->raza)
                            <div class="info-row">
                                <i class="bi bi-card-list info-icon"></i>
                                <span class="info-label">Raza:</span>
                                <span class="info-value">{{ $appointment->raza }}</span>
                            </div>
                            @endif

                            <div class="info-row">
                                <i class="bi bi-hourglass-split info-icon"></i>
                                <span class="info-label">Edad:</span>
                                <span class="info-value">{{ $appointment->edad }}</span>
                            </div>

                            <div class="info-row">
                                <i class="bi bi-chat-left-text info-icon"></i>
                                <span class="info-label">Motivo:</span>
                                <span class="info-value">{{ Str::limit($appointment->motivo, 60) }}</span>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex justify-content-end gap-2 mt-3 pt-3 border-top">
                                <button type="button" class="btn btn-sm btn-info" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#viewModal{{ $appointment->id }}">
                                    <i class="bi bi-eye me-1"></i> Ver Detalles
                                </button>

                                @if($appointment->estado !== 'completada' && $appointment->estado !== 'cancelada')
                                    <button type="button" class="btn btn-sm btn-warning"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $appointment->id }}">
                                        <i class="bi bi-pencil me-1"></i> Editar
                                    </button>
                                @endif

                                <form action="{{ route('appointments.destroy', $appointment->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('¿Está seguro de eliminar esta cita?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash me-1"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Ver Detalles -->
                <div class="modal fade" id="viewModal{{ $appointment->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header" style="background: linear-gradient(135deg, #2e7d32 0%, #43a047 100%); color: white;">
                                <h5 class="modal-title">
                                    <i class="bi bi-file-earmark-medical me-2"></i>
                                    Detalles de la Cita
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <h6 class="text-success border-bottom pb-2 mb-3">
                                    <i class="bi bi-person-circle me-2"></i>Información del Propietario
                                </h6>
                                <p><strong>Nombre:</strong> {{ $appointment->nombre_dueno }}</p>
                                <p><strong>Teléfono:</strong> {{ $appointment->telefono }}</p>
                                <p><strong>Email:</strong> {{ $appointment->email }}</p>

                                <h6 class="text-success border-bottom pb-2 mb-3 mt-4">
                                    <i class="bi bi-heart-pulse me-2"></i>Información de la Mascota
                                </h6>
                                <p><strong>Nombre:</strong> {{ $appointment->nombre_mascota }}</p>
                                <p><strong>Tipo:</strong> {!! $appointment->tipo_mascota_formateado !!}</p>
                                <p><strong>Raza:</strong> {{ $appointment->raza ?? 'No especificada' }}</p>
                                <p><strong>Edad:</strong> {{ $appointment->edad }}</p>

                                <h6 class="text-success border-bottom pb-2 mb-3 mt-4">
                                    <i class="bi bi-calendar-check me-2"></i>Detalles de la Cita
                                </h6>
                                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($appointment->fecha)->format('d/m/Y') }}</p>
                                <p><strong>Hora:</strong> {{ \Carbon\Carbon::parse($appointment->hora)->format('h:i A') }}</p>
                                <p><strong>Servicio:</strong> {{ $appointment->servicio_formateado }}</p>
                                <p><strong>Estado:</strong> 
                                    <span class="badge bg-{{ $appointment->estado_badge_color }}">
                                        {{ ucfirst($appointment->estado) }}
                                    </span>
                                </p>
                                <p><strong>Motivo:</strong></p>
                                <p class="bg-light p-3 rounded">{{ $appointment->motivo }}</p>

                                @if($appointment->notas)
                                    <p><strong>Notas adicionales:</strong></p>
                                    <p class="bg-light p-3 rounded">{{ $appointment->notas }}</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar -->
                @if($appointment->estado !== 'completada' && $appointment->estado !== 'cancelada')
                @include('Appointments.edit-modal', ['appointment' => $appointment])
                @endif
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $appointments->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-calendar-x"></i>
            <h4 class="text-muted">No hay citas programadas</h4>
            <p class="text-muted mb-0">Comienza creando tu primera cita veterinaria</p>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/appointments.js') }}"></script>
</body>
</html>
