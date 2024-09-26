<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tsubida
 *
 * @property $id
 * @property $usuario_id
 * @property $tarea_id
 * @property $proyecto_id
 * @property $descripcion
 * @property $imagen
 * @property $archivo
 * @property $fecha_subida
 * @property $created_at
 * @property $updated_at
 *
 * @property Proyecto $proyecto
 * @property Tarea $tarea
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tsubida extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'tsubidas';
    protected $primaryKey = 'id';
    
    static $rules = [
        'usuario_id' => 'required',
        'tarea_id' => 'required',
        'proyecto_id' => 'required',
        'descripcion' => 'required',
        'fecha_subida' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['usuario_id', 'tarea_id', 'proyecto_id', 'descripcion', 'imagen', 'archivo', 'fecha_subida'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}

