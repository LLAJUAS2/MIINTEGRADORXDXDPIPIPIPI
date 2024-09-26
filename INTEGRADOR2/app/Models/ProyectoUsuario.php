<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProyectoUsuario extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['proyecto_id', 'usuario_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /**
     * Define la relación con el modelo Proyecto.
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class);
    }

    /**
     * Define la relación con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
