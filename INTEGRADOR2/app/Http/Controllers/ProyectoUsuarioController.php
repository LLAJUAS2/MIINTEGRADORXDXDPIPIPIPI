<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyectoUsuario;

class ProyectoUsuarioController extends Controller
{
    
    public function store(Request $request)
    {
        // Obtén el ID del proyecto del formulario
        $proyecto_id = $request->input('proyecto_id');
        
        // Obtén los IDs de los usuarios seleccionados del formulario
        $usuarios_seleccionados = $request->input('usuarios');

        // Recorre los IDs de los usuarios seleccionados y guárdalos en la tabla proyecto_usuario
        foreach ($usuarios_seleccionados as $usuario_id) {
            ProyectoUsuario::create([
                'proyecto_id' => $proyecto_id,
                'usuario_id' => $usuario_id
            ]);
        }

        // Aquí puedes agregar cualquier otra lógica que necesites después de guardar los usuarios

        // Redirecciona o retorna una respuesta de éxito
        return redirect()->route('proyectos.index')->with('success', 'Usuarios asociados al proyecto guardados exitosamente.');
    }
}
