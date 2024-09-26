<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Proyecto
 *
 * @property $id
 * @property $titulo
 * @property $descripcion
 * @property $fecha_ini
 * @property $fecha_fin
 * @property $estado
 * @property $usuario_creador_id
 * @property $created_at
 * @property $updated_at
 *
 * @property ProyectoUsuario[] $proyectoUsuarios
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Proyecto extends Model
{
    use SoftDeletes;
    
    static $rules = [
        'titulo' => 'required|unique:proyectos,titulo',
        'descripcion' => 'required',
        'fecha_ini' => 'required',
        'fecha_fin' => 'required',
        'estado' => 'required',
        'usuario_creador_id' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['titulo','descripcion','fecha_ini','fecha_fin','estado','usuario_creador_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * Define la relación con el modelo ProyectoUsuario.
     */
    public function proyectoUsuarios()
    {
        return $this->hasMany(ProyectoUsuario::class, 'proyecto_id', 'id');
    }

    /**
     * Define la relación con el modelo User como creador del proyecto.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_creador_id', 'id');
    }

    /**
     * Define la relación muchos a muchos con el modelo User.
     */
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'proyecto_usuario', 'proyecto_id', 'usuario_id');
    }
    
    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }
}
