<?php

namespace App\Models\SATIM;

use App\Models\SATIM\PermisoEstadia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class VisitaPermisoEstadia
 * @package App\Models
 *
 * @property integer $permiso_estadia_id
 * @property string $nombre_visitador
 * @property string $fecha_visita
 */
class VisitaPermisoEstadia extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'visita_permiso_estadias';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'permiso_estadia_id',
        'nombre_visitador',
        'fecha_visita'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'permiso_estadia_id' => 'integer',
        'nombre_visitador' => 'string',
        'fecha_visita' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'permiso_estadia_id' => 'required',
        'nombre_visitador' => 'required',
        'fecha_visita' => 'required'
    ];

    public function permisoestadia() {
        return $this->belongsToMany(PermisoEstadia::class);
    }
}
