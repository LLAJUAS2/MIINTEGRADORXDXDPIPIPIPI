<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class UserController extends Controller
{
    public function pdf()
    {
        $users = User::with('roles')->get();
        $options = ['orientation' => 'landscape'];
        $pdf = PDF::loadView('user.REPORTES.pdf', compact('users'))->setPaper('A4', 'landscape');
        return $pdf->stream('users-report.pdf');
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'apPaterno' => 'required',
            'apMaterno' => 'required',
            'celular' => 'required|numeric',
            'nacimiento' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $fechaNacimiento = Carbon::parse($request->nacimiento);
        $edad = $fechaNacimiento->age;

        if ($edad < 18) {
            return redirect()->back()->withErrors(['nacimiento' => 'Debes ser mayor de 18 años para registrarte.'])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'apPaterno' => $request->apPaterno,
            'apMaterno' => $request->apMaterno,
            'celular' => $request->celular,
            'nacimiento' => $request->nacimiento,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'apPaterno' => 'required',
            'apMaterno' => 'required',
            'celular' => 'required',
            'nacimiento' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);

        return redirect()->route('users.index')
            ->with('success', 'Usuario editado correctamente');
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente');
    }

    
}
