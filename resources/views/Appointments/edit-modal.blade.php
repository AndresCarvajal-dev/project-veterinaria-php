<div class="modal fade" id="editModal{{ $appointment->id }}" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%); color: white;">
                <div>
                    <h5 class="modal-title mb-0">
                        <i class="bi bi-pencil-square me-2"></i>
                        Editar Cita Veterinaria
                    </h5>
                    <small class="opacity-90">Modifique los datos de la cita</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-4">
                <form action="{{ route('appointments.update', $appointment->id) }}" method="POST" id="editForm{{ $appointment->id }}">
                    @csrf
                    @method('PUT')

                    <!-- Información del Propietario -->
                    <h6 class="text-warning border-bottom pb-2 mb-3">
                        <i class="bi bi-person-circle me-2"></i>Información del Propietario
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre completo<span class="text-danger">*</span></label>
                            <input type="text" name="nombre_dueno" class="form-control" 
                                   value="{{ $appointment->nombre_dueno }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono<span class="text-danger">*</span></label>
                            <input type="tel" name="telefono" class="form-control" 
                                   value="{{ $appointment->telefono }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo electrónico<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" 
                               value="{{ $appointment->email }}" required>
                    </div>

                    <!-- Información de la Mascota -->
                    <h6 class="text-warning border-bottom pb-2 mb-3 mt-4">
                        <i class="bi bi-heart-pulse me-2"></i>Información de la Mascota
                    </h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre de la mascota<span class="text-danger">*</span></label>
                            <input type="text" name="nombre_mascota" class="form-control" 
                                   value="{{ $appointment->nombre_mascota }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de mascota<span class="text-danger">*</span></label>
                            <select name="tipo_mascota" class="form-select" required>
                                <option value="perro" {{ $appointment->tipo_mascota == 'perro' ? 'selected' : '' }}>🐕 Perro</option>
                                <option value="gato" {{ $appointment->tipo_mascota == 'gato' ? 'selected' : '' }}>🐈 Gato</option>
                                <option value="ave" {{ $appointment->tipo_mascota == 'ave' ? 'selected' : '' }}>🦜 Ave</option>
                                <option value="conejo" {{ $appointment->tipo_mascota == 'conejo' ? 'selected' : '' }}>🐰 Conejo</option>
                                <option value="hamster" {{ $appointment->tipo_mascota == 'hamster' ? 'selected' : '' }}>🐹 Hámster</option>
                                <option value="reptil" {{ $appointment->tipo_mascota == 'reptil' ? 'selected' : '' }}>🦎 Reptil</option>
                                <option value="otro" {{ $appointment->tipo_mascota == 'otro' ? 'selected' : '' }}>🐾 Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Raza</label>
                            <input type="text" name="raza" class="form-control" 
                                   value="{{ $appointment->raza }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Edad aproximada<span class="text-danger">*</span></label>
                            <input type="text" name="edad" class="form-control" 
                                   value="{{ $appointment->edad }}" required>
                        </div>
                    </div>

                    <!-- Detalles de la Cita -->
                    <h6 class="text-warning border-bottom pb-2 mb-3 mt-4">
                        <i class="bi bi-calendar-check me-2"></i>Detalles de la Cita
                    </h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de la cita<span class="text-danger">*</span></label>
                            <input type="date" name="fecha" class="form-control" 
                                   value="{{ $appointment->fecha->format('Y-m-d') }}" 
                                   min="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hora de la cita<span class="text-danger">*</span></label>
                            <select name="hora" class="form-select" required>
                                <option value="08:00" {{ substr($appointment->hora, 0, 5) == '08:00' ? 'selected' : '' }}>08:00 AM</option>
                                <option value="09:00" {{ substr($appointment->hora, 0, 5) == '09:00' ? 'selected' : '' }}>09:00 AM</option>
                                <option value="10:00" {{ substr($appointment->hora, 0, 5) == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                <option value="11:00" {{ substr($appointment->hora, 0, 5) == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                <option value="12:00" {{ substr($appointment->hora, 0, 5) == '12:00' ? 'selected' : '' }}>12:00 PM</option>
                                <option value="13:00" {{ substr($appointment->hora, 0, 5) == '13:00' ? 'selected' : '' }}>01:00 PM</option>
                                <option value="14:00" {{ substr($appointment->hora, 0, 5) == '14:00' ? 'selected' : '' }}>02:00 PM</option>
                                <option value="15:00" {{ substr($appointment->hora, 0, 5) == '15:00' ? 'selected' : '' }}>03:00 PM</option>
                                <option value="16:00" {{ substr($appointment->hora, 0, 5) == '16:00' ? 'selected' : '' }}>04:00 PM</option>
                                <option value="17:00" {{ substr($appointment->hora, 0, 5) == '17:00' ? 'selected' : '' }}>05:00 PM</option>
                                <option value="18:00" {{ substr($appointment->hora, 0, 5) == '18:00' ? 'selected' : '' }}>06:00 PM</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo de servicio<span class="text-danger">*</span></label>
                        <select name="servicio" class="form-select" required>
                            <option value="consulta_general" {{ $appointment->servicio == 'consulta_general' ? 'selected' : '' }}>Consulta General</option>
                            <option value="vacunacion" {{ $appointment->servicio == 'vacunacion' ? 'selected' : '' }}>Vacunación</option>
                            <option value="desparasitacion" {{ $appointment->servicio == 'desparasitacion' ? 'selected' : '' }}>Desparasitación</option>
                            <option value="cirugia" {{ $appointment->servicio == 'cirugia' ? 'selected' : '' }}>Cirugía</option>
                            <option value="emergencia" {{ $appointment->servicio == 'emergencia' ? 'selected' : '' }}>Emergencia</option>
                            <option value="revision_control" {{ $appointment->servicio == 'revision_control' ? 'selected' : '' }}>Revisión de Control</option>
                            <option value="estetica" {{ $appointment->servicio == 'estetica' ? 'selected' : '' }}>Estética/Peluquería</option>
                            <option value="rayos_x" {{ $appointment->servicio == 'rayos_x' ? 'selected' : '' }}>Rayos X</option>
                            <option value="analisis" {{ $appointment->servicio == 'analisis' ? 'selected' : '' }}>Análisis Clínicos</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Motivo de la consulta<span class="text-danger">*</span></label>
                        <textarea name="motivo" rows="3" class="form-control" required>{{ $appointment->motivo }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notas adicionales</label>
                        <textarea name="notas" rows="2" class="form-control">{{ $appointment->notas }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estado de la cita<span class="text-danger">*</span></label>
                        <select name="estado" class="form-select" required>
                            <option value="pendiente" {{ $appointment->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="confirmada" {{ $appointment->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="completada" {{ $appointment->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                            <option value="cancelada" {{ $appointment->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-warning" form="editForm{{ $appointment->id }}">
                    <i class="bi bi-check-circle me-2"></i>Guardar Cambios
                </button>
            </div>
        </div>
    </div>
</div>
