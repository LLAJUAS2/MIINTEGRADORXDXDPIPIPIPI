<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    // Reglas de validación
    public static $rules = [
        'name' => 'required|string|max:255',
        'apPaterno' => 'required|string|max:255',
        'apMaterno' => 'required|string|max:255',
        'celular' => 'required|string|max:255',
        'nacimiento' => 'required|date',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];

    // Atributos asignables
    protected $fillable = [
        'name', 'apPaterno', 'apMaterno', 'celular', 'nacimiento', 'email', 'password',
    ];

    // Atributos ocultos
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Nombre completo
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->apPaterno} {$this->apMaterno}";
    }

    // Relación muchos a muchos con Role
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Relación muchos a muchos con Proyecto
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_usuario', 'usuario_id', 'proyecto_id');
    }

    // Relación muchos a muchos con Tarea
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'tareasusuarios');
    }
}
