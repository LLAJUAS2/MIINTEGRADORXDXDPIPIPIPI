<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;
use App\Models\User;

use PDF;
/**
 * Class ProyectoController
 * @package App\Http\Controllers
 */
class ProyectoController extends Controller
{
    public function pdf()
    {
        $proyectos = Proyecto::with('tareas')->get();
       
        $pdf = PDF::loadView('proyecto.REPORTES.pdf', compact('proyectos'))->setPaper('a4', 'landscape');
        return $pdf->stream('proyectos-report.pdf');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Proyecto::query();
    
        if ($request->has('year') && $request->year != '') {
            $year = $request->input('year');
            $query->whereYear('fecha_ini', $year);
        }
    
        if ($request->has('estado') && $request->estado != '') {
            $estado = $request->input('estado');
            $query->where('estado', $estado);
        }
    
        $proyectos = $query->paginate(10);
    
        return view('proyecto.index', compact('proyectos'))
            ->with('i', (request()->input('page', 1) - 1) * $proyectos->perPage());
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $proyecto = new Proyecto();
    $usuarios = User::all(); // Suponiendo que tienes un modelo User para los usuarios
    return view('proyecto.create', compact('proyecto', 'usuarios'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Elimina la validación de los campos requeridos
    unset(Proyecto::$rules['usuario_creador_id']);
    unset(Proyecto::$rules['fecha_ini']);

    // Validar los datos del formulario
    $request->validate(Proyecto::$rules);

    // Establecer el ID del usuario creador antes de crear el proyecto
    $request->merge(['usuario_creador_id' => auth()->id()]);

    // Establecer la fecha de creación antes de crear el proyecto
    $request->merge(['fecha_ini' => now()->toDateString()]);

    // Crear el proyecto
    $proyecto = Proyecto::create($request->all());

    return redirect()->route('proyectos.index')
        ->with('success', 'Proyecto creado correctamente.');
}

    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyecto = Proyecto::find($id);

        return view('proyecto.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = Proyecto::find($id);
        $usuarios = User::all(); // Obtén todos los usuarios
        return view('proyecto.edit', compact('proyecto', 'usuarios'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Proyecto $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        // Elimina la validación de los campos requeridos
        //$request->validate(Proyecto::$rules);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto editado exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::find($id)->delete();

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto eliminado exitosamente');
    }
}
