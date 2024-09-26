<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;


use App\Models\RoleUser;
use Illuminate\Http\Request;

/**
 * Class RoleUserController
 * @package App\Http\Controllers
 */
class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $roleUsers = RoleUser::select('role_user.*', 'roles.nombre_rol', 'users.name', 'users.apPaterno', 'users.apMaterno')
        ->join('roles', 'role_user.role_id', '=', 'roles.id')
        ->join('users', 'role_user.user_id', '=', 'users.id')
        ->paginate(10);

    // Inicializar $i
    $i = ($roleUsers->currentPage() - 1) * $roleUsers->perPage();

    return view('role-user.index', compact('roleUsers', 'i'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener todos los usuarios
        $users = User::all();
    
        // Verificar si el usuario ya tiene un rol asignado
        $usersWithRole = RoleUser::pluck('user_id')->all();
    
        // Filtrar los usuarios que aún no tienen un rol asignado
        $usersWithoutRole = $users->reject(function ($user) use ($usersWithRole) {
            return in_array($user->id, $usersWithRole);
        });
    
        // Obtener todos los roles
        $roles = Role::all();
    
        // Pasar los usuarios y roles a la vista
        return view('role-user.create', compact('usersWithoutRole', 'roles', 'users'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar si el usuario ya tiene un rol asignado
    $existingRole = RoleUser::where('user_id', $request->user_id)->first();

    // Verificar si se encontró un rol existente para el usuario
    if ($existingRole) {
        return redirect()->back()->with('error', 'El usuario ya tiene un rol asignado.');
    }

    // Validar los datos del formulario
    $request->validate(RoleUser::$rules);

    // Crear el nuevo rol para el usuario
    $roleUser = RoleUser::create($request->all());

    return redirect()->route('roleuser.index')
        ->with('success', 'Rol asignado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roleUser = RoleUser::with('role', 'user')->find($id);

        return view('role-user.show', compact('roleUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roleUser = RoleUser::find($id);
        $roles = Role::all();
        $users = User::all();
    
        return view('role-user.edit', compact('roleUser', 'roles', 'users'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  RoleUser $roleUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Eliminar la validación del user_id
        request()->validate([
            'role_id' => 'required',
        ]);
    
        // Recuperar el modelo RoleUser por su ID
        $roleUser = RoleUser::find($id);
        
        // Verificar si se encontró el modelo
        if (!$roleUser) {
            return redirect()->back()->with('error', 'El Rol de Usuario no existe');
        }
    
        // Actualizar el campo role_id con el valor recibido del formulario
        $roleUser->role_id = $request->role_id;
        $roleUser->save();
    
        return redirect()->route('roleuser.index')
            ->with('success', 'Rol editado correctamente');
    }
    
    

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $roleUser = RoleUser::find($id)->delete();

        return redirect()->route('roleuser.index')
            ->with('success', 'Rol eliminado exitosamente');
    }
}
