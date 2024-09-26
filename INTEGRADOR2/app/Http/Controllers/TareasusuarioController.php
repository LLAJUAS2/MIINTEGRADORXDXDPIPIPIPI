<?php

namespace App\Http\Controllers;

use App\Models\Tareasusuario;
use Illuminate\Http\Request;

/**
 * Class TareasusuarioController
 * @package App\Http\Controllers
 */
class TareasusuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareasusuarios = Tareasusuario::paginate(10);

        return view('tareasusuario.index', compact('tareasusuarios'))
            ->with('i', (request()->input('page', 1) - 1) * $tareasusuarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   /**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
public function create()
{
    $usuarios = \App\Models\User::orderBy('name', 'asc')->get(); // Obtener todos los usuarios ordenados alfabéticamente por su nombre
    $tareas = \App\Models\Tarea::all(); // Obtener todas las tareas
    
    $tareasusuario = new Tareasusuario();
    return view('tareasusuario.create', compact('tareasusuario', 'usuarios', 'tareas'));
}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Tareasusuario::$rules);

        $tareasusuario = Tareasusuario::create($request->all());

        return redirect()->route('tareasusuarios.index')
            ->with('success', 'Tarea asignada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tareasusuario = Tareasusuario::find($id);

        return view('tareasusuario.show', compact('tareasusuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tareasusuario = Tareasusuario::find($id);
        $usuarios = \App\Models\User::all(); // Obtener todos los usuarios
        $tareas = \App\Models\Tarea::all(); // Obtener todas las tareas
        
        return view('tareasusuario.edit', compact('tareasusuario', 'usuarios', 'tareas'));
    }
    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tareasusuario $tareasusuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tareasusuario $tareasusuario)
    {
        request()->validate(Tareasusuario::$rules);

        $tareasusuario->update($request->all());

        return redirect()->route('tareasusuarios.index')
            ->with('success', 'Asignacion editada correctamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tareasusuario = Tareasusuario::find($id)->delete();

        return redirect()->route('tareasusuarios.index')
            ->with('success', 'Asignación eliminada correctamente');
    }
}
