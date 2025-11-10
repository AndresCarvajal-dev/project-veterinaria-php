<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display the dashboard with statistics.
     */
    public function dashboard()
    {
        $totalCitas = Appointment::count();
        $citasPendientes = Appointment::where('estado', 'pendiente')->count();
        $citasConfirmadas = Appointment::where('estado', 'confirmada')->count();
        $citasHoy = Appointment::whereDate('fecha', today())->count();
        
        $proximasCitas = Appointment::where('fecha', '>=', today())
                                    ->whereIn('estado', ['pendiente', 'confirmada'])
                                    ->orderBy('fecha', 'asc')
                                    ->orderBy('hora', 'asc')
                                    ->limit(10)
                                    ->get();

        return view('Appointments.dashboard', compact(
            'totalCitas',
            'citasPendientes',
            'citasConfirmadas',
            'citasHoy',
            'proximasCitas'
        ));
    }

    /**
     * Display a listing of the appointments.
     */
    public function index()
    {
        $appointments = Appointment::orderBy('fecha', 'desc')
                                   ->orderBy('hora', 'desc')
                                   ->paginate(10);
        return view('Appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        return view('Appointments.create');
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'nombre_dueno' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'nombre_mascota' => 'required|string|max:255',
            'tipo_mascota' => 'required|in:perro,gato,ave,conejo,hamster,reptil,otro',
            'raza' => 'nullable|string|max:255',
            'edad' => 'required|string|max:50',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'servicio' => 'required|in:consulta_general,vacunacion,desparasitacion,cirugia,emergencia,revision_control,estetica,rayos_x,analisis',
            'motivo' => 'required|string|min:4',
            'notas' => 'nullable|string',
        ], [
            'nombre_dueno.required' => 'El nombre del propietario es obligatorio.',
            'telefono.required' => 'El teléfono de contacto es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'nombre_mascota.required' => 'El nombre de la mascota es obligatorio.',
            'tipo_mascota.required' => 'Debe seleccionar el tipo de mascota.',
            'edad.required' => 'La edad de la mascota es obligatoria.',
            'fecha.required' => 'La fecha de la cita es obligatoria.',
            'fecha.after_or_equal' => 'La fecha debe ser hoy o una fecha futura.',
            'hora.required' => 'La hora de la cita es obligatoria.',
            'servicio.required' => 'Debe seleccionar el tipo de servicio.',
            'motivo.required' => 'El motivo de la consulta es obligatorio.',
            'motivo.min' => 'El motivo debe tener al menos 4 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar disponibilidad de la cita
        $citaExistente = Appointment::where('fecha', $request->fecha)
            ->where('hora', $request->hora)
            ->where('estado', '!=', 'cancelada')
            ->first();

        if ($citaExistente) {
            return redirect()->back()
                ->with('error', 'Lo sentimos, ese horario ya está ocupado. Por favor, elija otra hora.')
                ->withInput();
        }

        // Crear la cita
        $appointment = Appointment::create($request->all());

        return redirect()->route('appointments.index')
            ->with('success', '¡Cita agendada exitosamente! Recibirá un correo de confirmación pronto.');
    }

    /**
     * Display the specified appointment.
     */
    public function show(Appointment $appointment)
    {
        return view('Appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified appointment.
     */
    public function edit(Appointment $appointment)
    {
        return view('Appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified appointment in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'nombre_dueno' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'nombre_mascota' => 'required|string|max:255',
            'tipo_mascota' => 'required|in:perro,gato,ave,conejo,hamster,reptil,otro',
            'raza' => 'nullable|string|max:255',
            'edad' => 'required|string|max:50',
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio' => 'required|in:consulta_general,vacunacion,desparasitacion,cirugia,emergencia,revision_control,estetica,rayos_x,analisis',
            'motivo' => 'required|string|min:4',
            'notas' => 'nullable|string',
            'estado' => 'nullable|in:pendiente,confirmada,completada,cancelada',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar disponibilidad si se cambió fecha u hora
        $fechaAnterior = $appointment->fecha->format('Y-m-d');
        $horaAnterior = substr($appointment->hora, 0, 5);
        
        if ($request->fecha != $fechaAnterior || $request->hora != $horaAnterior) {
            $citaExistente = Appointment::where('fecha', $request->fecha)
                ->where('hora', $request->hora)
                ->where('id', '!=', $appointment->id)
                ->where('estado', '!=', 'cancelada')
                ->first();

            if ($citaExistente) {
                return redirect()->back()
                    ->with('error', 'Lo sentimos, ese horario ya está ocupado. Por favor, elija otra hora.')
                    ->withInput();
            }
        }

        // Actualizar la cita
        $appointment->update($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Cita actualizada exitosamente.');
    }

    /**
     * Remove the specified appointment from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Cita eliminada exitosamente.');
    }

    /**
     * Cancel the specified appointment.
     */
    public function cancel(Appointment $appointment)
    {
        $appointment->update(['estado' => 'cancelada']);

        return redirect()->route('appointments.show', $appointment->id)
            ->with('success', 'Cita cancelada exitosamente.');
    }

    /**
     * Confirm the specified appointment.
     */
    public function confirm(Appointment $appointment)
    {
        $appointment->update(['estado' => 'confirmada']);

        return redirect()->route('appointments.show', $appointment->id)
            ->with('success', 'Cita confirmada exitosamente.');
    }

    /**
     * Complete the specified appointment.
     */
    public function complete(Appointment $appointment)
    {
        $appointment->update(['estado' => 'completada']);

        return redirect()->route('appointments.show', $appointment->id)
            ->with('success', 'Cita marcada como completada.');
    }
}
