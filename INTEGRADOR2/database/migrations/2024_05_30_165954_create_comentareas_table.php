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
        Schema::create('comentareas', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->foreignId('parent_id')->nullable()->references('id')->on('comentareas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('tarea_id')->references('id')->on('tareas')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();  // Soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentareas');
    }
};
