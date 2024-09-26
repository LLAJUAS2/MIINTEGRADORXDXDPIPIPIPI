<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProyectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = Storage::disk('local')->get('/json/proyectos.json');
        $proyectos = json_decode($json, true);

        foreach ($proyectos as $proyecto) {
            Proyecto::updateOrCreate(
                ['titulo' => $proyecto['titulo']], // Condición de búsqueda para actualizar o crear
                [
                    'descripcion' => $proyecto['descripcion'],
                    'fecha_ini' => $proyecto['fecha_ini'],
                    'fecha_fin' => $proyecto['fecha_fin'],
                    'estado' => $proyecto['estado'],
                    'usuario_creador_id' => $proyecto['usuario_creador_id']
                ]
            );
        }
    }
}
