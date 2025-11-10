<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre_dueno',
        'telefono',
        'email',
        'nombre_mascota',
        'tipo_mascota',
        'raza',
        'edad',
        'fecha',
        'hora',
        'servicio',
        'motivo',
        'notas',
        'estado',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha' => 'date',
    ];

    /**
     * Obtener el nombre completo de la cita (propietario - mascota)
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombre_dueno} - {$this->nombre_mascota}";
    }

    /**
     * Scope para filtrar citas por estado
     */
    public function scopeEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    /**
     * Scope para filtrar citas por fecha
     */
    public function scopeFecha($query, $fecha)
    {
        return $query->whereDate('fecha', $fecha);
    }

    /**
     * Scope para citas futuras
     */
    public function scopeFuturas($query)
    {
        return $query->where('fecha', '>=', now()->toDateString())
                    ->orderBy('fecha', 'asc')
                    ->orderBy('hora', 'asc');
    }

    /**
     * Scope para citas pasadas
     */
    public function scopePasadas($query)
    {
        return $query->where('fecha', '<', now()->toDateString())
                    ->orderBy('fecha', 'desc')
                    ->orderBy('hora', 'desc');
    }

    /**
     * Obtener el nombre formateado del servicio
     */
    public function getServicioFormateadoAttribute(): string
    {
        $servicios = [
            'consulta_general' => 'Consulta General',
            'vacunacion' => 'Vacunación',
            'desparasitacion' => 'Desparasitación',
            'cirugia' => 'Cirugía',
            'emergencia' => 'Emergencia',
            'revision_control' => 'Revisión de Control',
            'estetica' => 'Estética/Peluquería',
            'rayos_x' => 'Rayos X',
            'analisis' => 'Análisis Clínicos',
        ];

        return $servicios[$this->servicio] ?? $this->servicio;
    }

    /**
     * Obtener el nombre formateado del tipo de mascota
     */
    public function getTipoMascotaFormateadoAttribute(): string
    {
        $tipos = [
            'perro' => '🐕 Perro',
            'gato' => '🐈 Gato',
            'ave' => '🦜 Ave',
            'conejo' => '🐰 Conejo',
            'hamster' => '🐹 Hámster',
            'reptil' => '🦎 Reptil',
            'otro' => '🐾 Otro',
        ];

        return $tipos[$this->tipo_mascota] ?? $this->tipo_mascota;
    }

    /**
     * Obtener el color del badge según el estado
     */
    public function getEstadoBadgeColorAttribute(): string
    {
        $colores = [
            'pendiente' => 'warning',
            'confirmada' => 'info',
            'completada' => 'success',
            'cancelada' => 'danger',
        ];

        return $colores[$this->estado] ?? 'secondary';
    }
}
