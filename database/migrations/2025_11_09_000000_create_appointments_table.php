<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            
            // Información del propietario
            $table->string('nombre_dueno');
            $table->string('telefono');
            $table->string('email');
            
            // Información de la mascota
            $table->string('nombre_mascota');
            $table->enum('tipo_mascota', ['perro', 'gato', 'ave', 'conejo', 'hamster', 'reptil', 'otro']);
            $table->string('raza')->nullable();
            $table->string('edad');
            
            // Detalles de la cita
            $table->date('fecha');
            $table->time('hora');
            $table->enum('servicio', [
                'consulta_general',
                'vacunacion',
                'desparasitacion',
                'cirugia',
                'emergencia',
                'revision_control',
                'estetica',
                'rayos_x',
                'analisis'
            ]);
            $table->text('motivo');
            $table->text('notas')->nullable();
            
            // Estado de la cita
            $table->enum('estado', ['pendiente', 'confirmada', 'completada', 'cancelada'])->default('pendiente');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
