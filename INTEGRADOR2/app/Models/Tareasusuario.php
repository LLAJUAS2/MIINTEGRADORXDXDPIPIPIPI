<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tareasusuario
 *
 * @property $id
 * @property $user_id
 * @property $tarea_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Tarea $tarea
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tareasusuario extends Model
{
    use SoftDeletes;

    static $rules = [
        'user_id' => 'required',
        'tarea_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'tarea_id'];

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
    public function tarea()
    {
        return $this->hasOne('App\Models\Tarea', 'id', 'tarea_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function tareasusuarios()
    {
        return $this->hasMany(Tareasusuario::class, 'tarea_id', 'id');
    }
}
