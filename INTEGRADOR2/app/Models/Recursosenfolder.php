<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Recursosenfolder
 *
 * @property $id
 * @property $folder_id
 * @property $usuario_id
 * @property $nomrecurso
 * @property $archivo
 * @property $fecha_subida
 * @property $created_at
 * @property $updated_at
 *
 * @property Folderproyecto $folderproyecto
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Recursosenfolder extends Model
{
    use SoftDeletes;
    
    static $rules = [
        'folder_id' => 'required',
        'usuario_id' => 'required',
        'nomrecurso' => 'required',
        'fecha_subida' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['folder_id','usuario_id','nomrecurso','archivo','fecha_subida'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function folderproyecto()
    {
        return $this->hasOne('App\Models\Folderproyecto', 'id', 'folder_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario_id');
    }
}
