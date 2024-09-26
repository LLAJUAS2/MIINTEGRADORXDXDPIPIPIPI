<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarea extends Model
{
    use SoftDeletes;

    // Reglas de validación
    static $rules = [
        'proyecto_id' => 'required',
        'nombre' => 'required',
    ];

    // Paginación
    protected $perPage = 20;

    // Atributos asignables
    protected $fillable = ['proyecto_id', 'nombre', 'descripcion', 'creador_id', 'revision', 'fecha_inicio', 'fecha_fin'];

    // The attributes that should be cast to native types.
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    // Relación con Proyecto
    public function proyecto()
    {
        return $this->hasOne('App\Models\Proyecto', 'id', 'proyecto_id');
    }

    // Relación con User
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'creador_id');
    }

    // Relación muchos a muchos con User
    public function users()
    {
        return $this->belongsToMany(User::class, 'tareasusuarios');
    }
    public function tareasusuarios()
    {
        return $this->hasMany(Tareasusuario::class, 'tarea_id', 'id');
    }
}
