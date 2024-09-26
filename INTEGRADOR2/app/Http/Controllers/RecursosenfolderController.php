<?php

namespace App\Http\Controllers;

use App\Models\Recursosenfolder;
use Illuminate\Http\Request;

/**
 * Class RecursosenfolderController
 * @package App\Http\Controllers
 */
class RecursosenfolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $query = Recursosenfolder::query();

    // Obtener el término de búsqueda
    if ($request->has('search') && $request->search != '') {
        $query->where('nombre', 'LIKE', "%{$request->search}%");
    }

    // Filtrar por proyecto_id
    if ($request->has('folder_id') && $request->folder_id != '') {
        $query->where('folder_id', $request->folder_id);
    }

    $recursosenfolders = $query->paginate(10); // Cambio de nombre de variable

    // Obtener todos los títulos de proyectos para el dropdown
    $folders = \App\Models\Folderproyecto::select('id', 'nombre')->get();

    return view('recursosenfolder.index', compact('recursosenfolders', 'folders'))
        ->with('i', (request()->input('page', 1) - 1) * $recursosenfolders->perPage()); // Cambio de nombre de variable
}


    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    \Log::info('Create method called');
    $recursosenfolder = new Recursosenfolder();
    $folders = \App\Models\Folderproyecto::select('id', 'nombre')->get();
    return view('recursosenfolder.create', compact('recursosenfolder', 'folders'));
}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'folder_id' => 'required',
            'usuario_id' => 'required',
            'nomrecurso' => 'required|string|max:255',
            'archivo' => 'required|mimes:pdf,docx,mp4,psd,svg,png,rar,zip|max:16000', // Validar el archivo
        ]);

        // Obtener todos los datos de la solicitud
        $requestData = $request->all();

        // Procesar el archivo, si se ha proporcionado
        if ($request->hasFile('archivo')) {
            // Obtener el nombre único del archivo
            $filename = time() . '_' . $request->file('archivo')->getClientOriginalName();
            
            // Almacenar el archivo en el directorio 'public/archivos'
            $path = $request->file('archivo')->storeAs('archivos', $filename, 'public');
            
            // Asignar la ruta de almacenamiento a la solicitud
            $requestData['archivo'] = '/storage/' . $path;
        }

        // Crear una nueva entrada de Recursosenfolder con los datos proporcionados
        Recursosenfolder::create($requestData);

        // Redirigir a la ruta index de recursosenfolders con un mensaje de éxito
        return redirect()->route('recursosenfolders.index')
                         ->with('success', 'Recurso creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recursosenfolder = Recursosenfolder::find($id);

        return view('recursosenfolder.show', compact('recursosenfolder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recursosenfolder = Recursosenfolder::find($id);
        $folders = \App\Models\Folderproyecto::select('id', 'nombre')->get();
    
        return view('recursosenfolder.edit', compact('recursosenfolder', 'folders'));
    }
    
 


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Recursosenfolder $recursosenfolder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recursosenfolder $recursosenfolder)
    {
        // Validar los datos de entrada
        $request->validate([
            'archivo' => 'nullable|mimes:pdf,mp4,psd,svg,png,rar,zip|max:2048',
            'folder_id' => 'required|integer',
            'nomrecurso' => 'required|string|max:255',
        ]);

        // Obtener todos los datos de la solicitud
        $requestData = $request->all();

        // Procesar el archivo, si se ha proporcionado
        if ($request->hasFile('archivo')) {
            // Obtener el nombre único del archivo
            $filename = time() . '_' . $request->file('archivo')->getClientOriginalName();

            // Almacenar el archivo en el directorio 'public/archivos'
            $path = $request->file('archivo')->storeAs('archivos', $filename, 'public');

            // Asignar la ruta de almacenamiento a la solicitud
            $requestData['archivo'] = '/storage/' . $path;

            // Eliminar el archivo anterior si existe
            if ($recursosenfolder->archivo) {
                \Storage::disk('public')->delete(str_replace('/storage/', '', $recursosenfolder->archivo));
            }
        }

        // Actualizar el recurso con los datos proporcionados
        $recursosenfolder->update($requestData);

        // Redirigir a la ruta index con un mensaje de éxito
        return redirect()->route('recursosenfolders.index')
            ->with('success', 'Recursos editados correctamente');
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $recursosenfolder = Recursosenfolder::find($id)->delete();

        return redirect()->route('recursosenfolders.index')
            ->with('success', 'Recursos eliminados exitosamente');
    }
}
