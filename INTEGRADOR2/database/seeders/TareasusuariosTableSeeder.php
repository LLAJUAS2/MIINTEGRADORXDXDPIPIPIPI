<?php

namespace Database\Seeders;

use App\Models\Tareasusuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TareasusuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Leer el archivo JSON desde la ruta especificada
        $json = Storage::disk('local')->get('/json/tareasusuarios.json');
        $tareasusuarios = json_decode($json, true);

        // Recorrer los datos y crear o actualizar los registros en la base de datos
        foreach ($tareasusuarios as $tareasusuario) {
            Tareasusuario::updateOrCreate(
                // Condición de búsqueda para actualizar o crear
                ['user_id' => $tareasusuario['user_id'], 'tarea_id' => $tareasusuario['tarea_id']],
                // Campos a actualizar o crear
                []
            );
        }
    }
}
