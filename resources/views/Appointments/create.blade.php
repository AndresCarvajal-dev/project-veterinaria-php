<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cita Veterinaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/appointments.css') }}" rel="stylesheet">
</head>
<body>

<div class="card card-appointment">
    <div class="card-header-custom">
        <div class="d-flex align-items-center">
            <div class="me-3">
                <i class="bi bi-calendar-heart text-white" style="font-size: 48px;"></i>
            </div>
            <div>
                <h3 class="mb-1">Agendar Nueva Cita Veterinaria</h3>
                <p class="mb-0 opacity-90">Complete el formulario para programar una cita médica</p>
            </div>
        </div>
    </div>

    <div class="card-body p-4">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Por favor, corrija los siguientes errores:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('appointments.store') }}" method="POST" novalidate>
            @csrf

            <!-- Información del Dueño -->
            <h5 class="section-title"><i class="bi bi-person-circle me-2"></i>Información del Propietario</h5>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre_dueno" class="form-label">Nombre completo<span class="required-asterisk">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text form-icon"><i class="bi bi-person"></i></span>
                        <input type="text" name="nombre_dueno" id="nombre_dueno" 
                               class="form-control @error('nombre_dueno') is-invalid @enderror" 
                               value="{{ old('nombre_dueno') }}" 
                               placeholder="Ej: Juan Pérez García"
                               required>
                    </div>
                    @error('nombre_dueno')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="telefono" class="form-label">Teléfono de contacto<span class="required-asterisk">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text form-icon"><i class="bi bi-telephone"></i></span>
                        <input type="tel" name="telefono" id="telefono" 
                               class="form-control @error('telefono') is-invalid @enderror" 
                               value="{{ old('telefono') }}"
                               placeholder="Ej: 555-1234"
                               required>
                    </div>
                    @error('telefono')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico<span class="required-asterisk">*</span></label>
                <div class="input-group">
                    <span class="input-group-text form-icon"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email') }}"
                           placeholder="ejemplo@correo.com"
                           required>
                </div>
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @else
                    <div class="help-block">Enviaremos la confirmación a este correo</div>
                @enderror
            </div>

            <!-- Información de la Mascota -->
            <h5 class="section-title"><i class="bi bi-heart-pulse me-2"></i>Información de la Mascota</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nombre_mascota" class="form-label">Nombre de la mascota<span class="required-asterisk">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text form-icon"><i class="bi bi-tag"></i></span>
                        <input type="text" name="nombre_mascota" id="nombre_mascota" 
                               class="form-control @error('nombre_mascota') is-invalid @enderror" 
                               value="{{ old('nombre_mascota') }}"
                               placeholder="Ej: Max, Luna, Firulais"
                               required>
                    </div>
                    @error('nombre_mascota')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tipo_mascota" class="form-label">Tipo de mascota<span class="required-asterisk">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text form-icon"><i class="bi bi-bezier2"></i></span>
                        <select name="tipo_mascota" id="tipo_mascota" 
                                class="form-select @error('tipo_mascota') is-invalid @enderror" 
                                required>
                            <option value="">Seleccione el tipo</option>
                            <option value="perro" {{ old('tipo_mascota') == 'perro' ? 'selected' : '' }}>🐕 Perro</option>
                            <option value="gato" {{ old('tipo_mascota') == 'gato' ? 'selected' : '' }}>🐈 Gato</option>
                            <option value="ave" {{ old('tipo_mascota') == 'ave' ? 'selected' : '' }}>🦜 Ave</option>
                            <option value="conejo" {{ old('tipo_mascota') == 'conejo' ? 'selected' : '' }}>🐰 Conejo</option>
                            <option value="hamster" {{ old('tipo_mascota') == 'hamster' ? 'selected' : '' }}>🐹 Hámster</option>
                            <option value="reptil" {{ old('tipo_mascota') == 'reptil' ? 'selected' : '' }}>🦎 Reptil</option>
                            <option value="otro" {{ old('tipo_mascota') == 'otro' ? 'selected' : '' }}>🐾 Otro</option>
                        </select>
                    </div>
                    @error('tipo_mascota')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="raza" class="form-label">Raza</label>
                    <div class="input-group">
                        <span class="input-group-text form-icon"><i class="bi bi-card-list"></i></span>
                        <input type="text" name="raza" id="raza" 
                               class="form-control @error('raza') is-invalid @enderror" 
                               value="{{ old('raza') }}"
                               placeholder="Ej: Labrador, Siamés, Mestizo">
                    </div>
                    @error('raza')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @else
                        <div class="help-block">Opcional: Indique la raza si la conoce</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="edad" class="form-label">Edad aproximada<span class="required-asterisk">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text form-icon"><i class="bi bi-calendar3"></i></span>
                        <input type="text" name="edad" id="edad" 
                               class="form-control @error('edad') is-invalid @enderror" 
                               value="{{ old('edad') }}"
                               placeholder="Ej: 3 años, 6 meses"
                               required>
                    </div>
                    @error('edad')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Detalles de la Cita -->
            <h5 class="section-title"><i class="bi bi-calendar-check me-2"></i>Detalles de la Cita</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fecha" class="form-label">Fecha de la cita<span class="required-asterisk">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text form-icon"><i class="bi bi-calendar-event"></i></span>
                        <input type="date" name="fecha" id="fecha" 
                               class="form-control @error('fecha') is-invalid @enderror" 
                               value="{{ old('fecha') }}"
                               min="{{ date('Y-m-d') }}"
                               required>
                    </div>
                    @error('fecha')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="hora" class="form-label">Hora de la cita<span class="required-asterisk">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text form-icon"><i class="bi bi-clock"></i></span>
                        <select name="hora" id="hora" 
                                class="form-select @error('hora') is-invalid @enderror" 
                                required>
                            <option value="">Seleccione la hora</option>
                            <option value="08:00" {{ old('hora') == '08:00' ? 'selected' : '' }}>08:00 AM</option>
                            <option value="09:00" {{ old('hora') == '09:00' ? 'selected' : '' }}>09:00 AM</option>
                            <option value="10:00" {{ old('hora') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                            <option value="11:00" {{ old('hora') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                            <option value="12:00" {{ old('hora') == '12:00' ? 'selected' : '' }}>12:00 PM</option>
                            <option value="13:00" {{ old('hora') == '13:00' ? 'selected' : '' }}>01:00 PM</option>
                            <option value="14:00" {{ old('hora') == '14:00' ? 'selected' : '' }}>02:00 PM</option>
                            <option value="15:00" {{ old('hora') == '15:00' ? 'selected' : '' }}>03:00 PM</option>
                            <option value="16:00" {{ old('hora') == '16:00' ? 'selected' : '' }}>04:00 PM</option>
                            <option value="17:00" {{ old('hora') == '17:00' ? 'selected' : '' }}>05:00 PM</option>
                            <option value="18:00" {{ old('hora') == '18:00' ? 'selected' : '' }}>06:00 PM</option>
                        </select>
                    </div>
                    @error('hora')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="servicio" class="form-label">Tipo de servicio<span class="required-asterisk">*</span></label>
                <div class="input-group">
                    <span class="input-group-text form-icon"><i class="bi bi-clipboard2-pulse"></i></span>
                    <select name="servicio" id="servicio" 
                            class="form-select @error('servicio') is-invalid @enderror" 
                            required>
                        <option value="">Seleccione el servicio</option>
                        <option value="consulta_general" {{ old('servicio') == 'consulta_general' ? 'selected' : '' }}>Consulta General</option>
                        <option value="vacunacion" {{ old('servicio') == 'vacunacion' ? 'selected' : '' }}>Vacunación</option>
                        <option value="desparasitacion" {{ old('servicio') == 'desparasitacion' ? 'selected' : '' }}>Desparasitación</option>
                        <option value="cirugia" {{ old('servicio') == 'cirugia' ? 'selected' : '' }}>Cirugía</option>
                        <option value="emergencia" {{ old('servicio') == 'emergencia' ? 'selected' : '' }}>Emergencia</option>
                        <option value="revision_control" {{ old('servicio') == 'revision_control' ? 'selected' : '' }}>Revisión de Control</option>
                        <option value="estetica" {{ old('servicio') == 'estetica' ? 'selected' : '' }}>Estética/Peluquería</option>
                        <option value="rayos_x" {{ old('servicio') == 'rayos_x' ? 'selected' : '' }}>Rayos X</option>
                        <option value="analisis" {{ old('servicio') == 'analisis' ? 'selected' : '' }}>Análisis Clínicos</option>
                    </select>
                </div>
                @error('servicio')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo de la consulta<span class="required-asterisk">*</span></label>
                <div class="input-group">
                    <span class="input-group-text form-icon align-items-start pt-2"><i class="bi bi-chat-left-text"></i></span>
                    <textarea name="motivo" id="motivo" rows="4" 
                              class="form-control @error('motivo') is-invalid @enderror"
                              placeholder="Describa brevemente el motivo de la consulta, síntomas observados o tratamiento requerido..."
                              required>{{ old('motivo') }}</textarea>
                </div>
                @error('motivo')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @else
                    <div class="help-block">Proporcione información detallada para preparar mejor la cita</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="notas" class="form-label">Notas adicionales</label>
                <div class="input-group">
                    <span class="input-group-text form-icon align-items-start pt-2"><i class="bi bi-journal-text"></i></span>
                    <textarea name="notas" id="notas" rows="3" 
                              class="form-control @error('notas') is-invalid @enderror"
                              placeholder="Información adicional, alergias, medicamentos actuales, comportamiento especial, etc.">{{ old('notas') }}</textarea>
                </div>
                @error('notas')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @else
                    <div class="help-block">Opcional: Cualquier información relevante que deba conocer el veterinario</div>
                @enderror
            </div>

            <!-- Botones de Acción -->
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-arrow-left me-2"></i> Volver al inicio
                </a>

                <div>
                    <button type="reset" class="btn btn-light btn-lg me-2">
                        <i class="bi bi-x-circle me-1"></i> Limpiar formulario
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-calendar-check me-2"></i> Agendar Cita
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/appointments.js') }}"></script>
</body>
</html>
