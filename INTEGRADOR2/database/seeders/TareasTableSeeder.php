<?php

namespace Database\Seeders;

use App\Models\Tarea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TareasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = Storage::disk('local')->get('/json/tareas.json');
        $tareas = json_decode($json, true);

        foreach ($tareas as $tarea) {
            Tarea::updateOrCreate(
                ['nombre' => $tarea['nombre'], 'proyecto_id' => $tarea['proyecto_id']], // Condición de búsqueda para actualizar o crear
                [
                    'descripcion' => $tarea['descripcion'],
                    'creador_id' => $tarea['creador_id'],
                    'fecha_inicio' => $tarea['fecha_inicio'],
                    'fecha_fin' => $tarea['fecha_fin']
                ]
            );
        }
    }
}
