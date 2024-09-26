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
        Schema::create('recursosenfolders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folder_id');
            $table->unsignedBigInteger('usuario_id');
            $table->string('nomrecurso', 70);
            $table->string('archivo')->nullable();
            $table->date('fecha_subida');
            $table->timestamps();
            $table->softDeletes();  // Soft delete

            $table->foreign('folder_id')->references('id')->on('folderproyectos')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recursosenfolders');
    }
};
