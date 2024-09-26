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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 45);
            $table->text('descripcion');
            $table->date('fecha_ini');
            $table->date('fecha_fin');
            $table->enum('estado', ['activo', 'inactivo', 'completado', 'en_revision', 'primera_fase', 'fase_final'])->default('activo');
            $table->unsignedBigInteger('usuario_creador_id');
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();  // Soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
