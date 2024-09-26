<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Proyecto;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Obtener el ID del usuario seleccionado
        $selectedUserId = $request->get('user_id', 'all');
        $users = User::all();

        if ($selectedUserId == 'all') {
            $tasks = User::with('tareas')->get();
        } else {
            $tasks = User::with('tareas')->where('id', $selectedUserId)->get();
        }

        // Obtener el año seleccionado
        $selectedYear = $request->get('year', Carbon::now()->year);
        $years = range(2018, Carbon::now()->year);

        // Filtrar proyectos por año
        $projects = Proyecto::whereYear('fecha_ini', $selectedYear)->get();

        return view('home', compact('users', 'tasks', 'selectedUserId', 'projects', 'years', 'selectedYear'));
    }
}
