<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProyectoController;
use Barryvdh\DomPDF\Facade\Pdf;


Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('user/REPORTES/pdf', [UserController::class, 'pdf'])->name('user.REPORTES.pdf');
Route::get('proyecto/REPORTES/pdf', [ProyectoController::class, 'pdf'])->name('proyecto.REPORTES.pdf');

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/roleuser', App\Http\Controllers\RoleUserController::class);
Route::resource('/users', App\Http\Controllers\UserController::class);
Route::resource('/roles', App\Http\Controllers\RoleController::class);
Route::resource('/proyectos', App\Http\Controllers\ProyectoController::class);
Route::resource('/tareas', App\Http\Controllers\TareaController::class);
Route::resource('/tareasusuarios', App\Http\Controllers\TareasusuarioController::class);

Route::resource('/tsubidas', App\Http\Controllers\TsubidaController::class);








Route::resource('/folderproyectos', App\Http\Controllers\FolderproyectoController::class);


Route::resource('recursosenfolders', App\Http\Controllers\RecursosenfolderController::class)->except(['index']);
Route::get('recursosenfolders/{folder_id?}', [App\Http\Controllers\RecursosenfolderController::class, 'index'])->name('recursosenfolders.index');









