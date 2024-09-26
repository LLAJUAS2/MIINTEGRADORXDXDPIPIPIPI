<?php

namespace App\Http\Controllers;

use App\Models\Folderproyecto;
use Illuminate\Http\Request;

/**
 * Class FolderproyectoController
 * @package App\Http\Controllers
 */
class FolderproyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Folderproyecto::query();
    
        // Obtener el término de búsqueda
        if ($request->has('search') && $request->search != '') {
            $query->where('nombre', 'LIKE', "%{$request->search}%");
        }
    
        // Filtrar por proyecto_id
        if ($request->has('proyecto_id') && $request->proyecto_id != '') {
            $query->where('proyecto_id', $request->proyecto_id);
        }
    
        // Obtener todos los proyectos y ordenarlos alfabéticamente por su título
        $proyectos = \App\Models\Proyecto::orderBy('titulo', 'asc')->select('id', 'titulo')->get();
    
        $folderproyectos = $query->paginate(10);
    
        return view('folderproyecto.index', compact('folderproyectos', 'proyectos'))
            ->with('i', (request()->input('page', 1) - 1) * $folderproyectos->perPage());
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $folderproyecto = new \App\Models\Folderproyecto();
        $proyectos = \App\Models\Proyecto::select('id', 'titulo')->get();
        return view('folderproyecto.create', compact('folderproyecto', 'proyectos'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    request()->validate(Folderproyecto::$rules);

    $folderproyecto = new Folderproyecto();
    $folderproyecto->nombre = $request->nombre;
    $folderproyecto->proyecto_id = $request->proyecto_id; // Almacena el id del proyecto, no el título

    $folderproyecto->save();

    return redirect()->route('folderproyectos.index')
        ->with('success', 'Folder creado exitosamente.');
}

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $folderproyecto = Folderproyecto::find($id);

        return view('folderproyecto.show', compact('folderproyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $folderproyecto = \App\Models\Folderproyecto::find($id);
        $proyectos = \App\Models\Proyecto::select('id', 'titulo')->get();
        return view('folderproyecto.edit', compact('folderproyecto', 'proyectos'));
    }
    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Folderproyecto $folderproyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folderproyecto $folderproyecto)
    {
        request()->validate(Folderproyecto::$rules);

        $folderproyecto->update($request->all());

        return redirect()->route('folderproyectos.index')
            ->with('success', 'Datos del folder editados exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $folderproyecto = Folderproyecto::find($id)->delete();

        return redirect()->route('folderproyectos.index')
            ->with('success', 'Folder editado exitosamente');
    }
}
