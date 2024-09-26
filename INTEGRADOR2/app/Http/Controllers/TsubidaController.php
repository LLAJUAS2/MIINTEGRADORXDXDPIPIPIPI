<?php

namespace App\Http\Controllers;

use App\Models\Tsubida;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\Tarea;
use App\Models\Tareasusuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TsubidaController extends Controller
{
    public function index()
    {
        $tsubidas = Tsubida::paginate(10);

        return view('tsubida.index', compact('tsubidas'))
                ->with('i', (request()->input('page', 1) - 1) * $tsubidas->perPage());
    }

    public function create()
    {
        $tsubida = new Tsubida();
        $tsubida->fecha_subida = Carbon::now()->toDateString();
        
        $currentUser = Auth::user(); // Obtener el usuario autenticado
    
        // Obtener solo las tareas asignadas al usuario actual
        $tareas = Tarea::whereHas('tareasusuarios', function($query) use ($currentUser) {
            $query->where('user_id', $currentUser->id);
        })->pluck('nombre', 'id');
    
        $proyectos = Proyecto::pluck('titulo', 'id');
        $usuarios = User::all(); // Obtener todos los usuarios
    
        return view('tsubida.create', compact('tsubida', 'proyectos', 'tareas', 'usuarios', 'currentUser'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:pdf,mp4,psd,svg,png,rar,zip|max:16000',
        ]);

        $requestData = $request->all();

        if ($request->hasFile('imagen')) {
            $filename = time() . $request->file('imagen')->getClientOriginalName();
            $path = $request->file('imagen')->storeAs('images', $filename, 'public');
            $requestData['imagen'] = '/storage/' . $path;
        }

        if ($request->hasFile('archivo')) {
            $filename = time() . '_' . $request->file('archivo')->getClientOriginalName();
            $path = $request->file('archivo')->storeAs('archivos', $filename, 'public');
            $requestData['archivo'] = '/storage/' . $path;
        }

        $tsubida = Tsubida::create($requestData);

        return redirect()->route('tsubidas.index')
                         ->with('success', 'Tarea subida exitosamente');
    }

    public function show($id)
    {
        $tsubida = Tsubida::find($id);

        return view('tsubida.show', compact('tsubida'));
    }

    public function edit($id)
    {
        $tsubida = Tsubida::findOrFail($id);
        $usuarios = User::all();
        $proyectos = Proyecto::pluck('titulo', 'id');
        $tareas = Tarea::pluck('nombre', 'id');
        
        return view('tsubida.edit', compact('tsubida', 'proyectos', 'usuarios', 'tareas'));
    }

    public function update(Request $request, Tsubida $tsubida)
    {
        $request->validate([
            'usuario_id' => 'required',
            'tarea_id' => 'required',
            'proyecto_id' => 'required',
            'descripcion' => 'required',
            'fecha_subida' => 'required',
            'imagen' => 'nullable|image|max:16000',
            'archivo' => 'nullable|mimes:pdf,mp4,psd,svg,png,rar,zip|max:2048',
        ]);

        $requestData = $request->all();

        if ($request->hasFile('imagen')) {
            $filename = time() . $request->file('imagen')->getClientOriginalName();
            $path = $request->file('imagen')->storeAs('images', $filename, 'public');
            $requestData['imagen'] = '/storage/' . $path;
        }

        if ($request->hasFile('archivo')) {
            $filename = time() . '_' . $request->file('archivo')->getClientOriginalName();
            $path = $request->file('archivo')->storeAs('archivos', $filename, 'public');
            $requestData['archivo'] = '/storage/' . $path;
        }

        $tsubida->update($requestData);

        return redirect()->route('tsubidas.index')
                         ->with('success', 'Tarea editada exitosamente');
    }

    public function destroy($id)
    {
        $tsubida = Tsubida::find($id)->delete();

        return redirect()->route('tsubidas.index')
                         ->with('success', 'Tarea eliminada exitosamente');
    }
}
