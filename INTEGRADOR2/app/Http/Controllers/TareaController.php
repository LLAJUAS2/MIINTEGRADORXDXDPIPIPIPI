<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\User;

class TareaController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los filtros
        $proyectoId = $request->input('proyecto');
        $usuarioId = $request->input('usuario');

        // Crear la consulta base
        $query = Tarea::with('users', 'proyecto', 'user');

        // Aplicar filtros si existen
        if ($proyectoId) {
            $query->where('proyecto_id', $proyectoId);
        }

        if ($usuarioId) {
            $query->whereHas('users', function($q) use ($usuarioId) {
                $q->where('users.id', $usuarioId);
            });
        }

        $tareas = $query->paginate(10);

        // Obtener todos los proyectos y usuarios para los filtros
        $proyectos = Proyecto::orderBy('titulo', 'asc')->get();
        $usuarios = User::orderBy('name', 'asc')->get();

        return view('tarea.index', compact('tareas', 'proyectos', 'usuarios'))
            ->with('i', (request()->input('page', 1) - 1) * $tareas->perPage());
    }

    public function create()
    {
        $tarea = new Tarea();
        $proyectos = Proyecto::orderBy('titulo', 'asc')->get();

        return view('tarea.create', compact('tarea', 'proyectos'));
    }

    public function store(Request $request)
    {
        $request->validate(Tarea::$rules);

        $tarea = new Tarea($request->all());
        $tarea->fecha_inicio = now();
        $tarea->creador_id = auth()->user()->id;

        $tarea->save();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea creada exitosamente.');
    }

    public function show($id)
    {
        $tarea = Tarea::find($id);

        return view('tarea.show', compact('tarea'));
    }

    public function edit($id)
    {
        $tarea = Tarea::find($id);
        $proyectos = Proyecto::all();

        return view('tarea.edit', compact('tarea', 'proyectos'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $request->validate(Tarea::$rules);

        $tarea->update($request->all());

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea editada exitosamente');
    }

    public function destroy($id)
    {
        Tarea::find($id)->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada exitosamente');
    }
}
