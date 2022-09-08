<?php

namespace App\Models\SATIM;

use App\Models\Publico\Departamento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PermisoEstadia
 * @package App\Models
 * @version March 10, 2022, 10:25 pm UTC
 *
 * @property string $nro_solicitud
 * @property string $cantidad_solicitud
 * @property unsignedBigInteger $user_id
 * @property string $nombre_buque
 * @property string $nro_registro
 * @property string $tipo_buque
 * @property string $nacionalidad_buque
 * @property string $arqueo_bruto
 * @property string $eslora
 * @property string $potencia_kw
 * @property string $manga
 *  @property string $puntal
 * @property string $nombre_propietario
 * @property string $nombre_capitan
 * @property string $pasaporte_capitan
 * @property integer $cant_tripulantes
 * @property integer $cant_pasajeros
 * @property string $actividades
 * @property string $puerto_origen
 * @property unsignedBigInteger $capitania_id
 * @property unsignedBigInteger $establecimiento_nautico_id
 * @property string $ultimo_puerto_zarpe
 * @property date $fecha_arribo
 * @property string $tiempo_estadia
 * @property string $vigencia
 * @property date $vencimiento
 * @property unsignedBigInteger $status_id
 */
class PermisoEstadia extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'permiso_estadias';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nro_solicitud',
        'cantidad_solicitud',
        'user_id',
        'nombre_buque',
        'nro_registro',
        'tipo_buque',
        'nacionalidad_buque',
        'arqueo_bruto',
        'eslora',
        'manga',
        'puntal',
        'potencia_kw',
        'nombre_propietario',
        'nombre_capitan',
        'pasaporte_capitan',
        'cant_tripulantes',
        'cant_pasajeros',
        'actividades',
        'puerto_origen',
        'capitania_id',
        'establecimiento_nautico_id',
        'ultimo_puerto_zarpe',
        'fecha_arribo',
        'tiempo_estadia',
        'vigencia',
        'vencimiento',
        'status_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nro_solicitud' => 'string',
        'cantidad_solicitud'=>'string',
        'user_id' => 'integer',
        'nombre_buque' => 'string',
        'nro_registro' => 'string',
        'tipo_buque' => 'string',
        'nacionalidad_buque' => 'string',
        'arqueo_bruto' => 'string',
        'eslora'=>'string',
        'manga'=>'string',
        'puntal'=>'string',
        'potencia_kw'=>'string',
        'nombre_propietario' => 'string',
        'nombre_capitan' => 'string',
        'pasaporte_capitan' => 'string',
        'cant_tripulantes' => 'integer',
        'cant_pasajeros' => 'integer',
        'actividades' => 'string',
        'puerto_origen' => 'string',
        'establecimiento_nautico_id' => 'integer',
        'ultimo_puerto_zarpe'=>'string',
        'capitania_id' => 'integer',
        'tiempo_estadia' => 'string',
        'fecha_arribo'=>'date',
        'vigencia' => 'string',
        'vencimiento'=>'date',
        'status_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre_buque' => 'required',
        'nro_registro' => 'required',
        'tipo_buque' => 'required',
        'nacionalidad_buque' => 'required',
        'arqueo_bruto' => 'required',
        'eslora'=>'required',
        'potencia_kw'=>'required',
        'nombre_propietario' => 'required',
        'nombre_capitan' => 'required',
        'pasaporte_capitan' => 'required',
        'cant_tripulantes' => 'required',
        'cant_pasajeros' => 'required',
        'actividades' => 'required',
        'puerto_origen' => 'required',
        'capitania_id' => 'required',
        'tiempo_estadia' => 'required',
        'fecha_arribo'=>'required',
        'manga'=>'required',
        'puntal'=>'required',
        'establecimiento_nautico_id'=>'required',
        'permanencia_marina'=>'required',
    ];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function establecimientos()
    {
        return $this->belongsTo(EstablecimientoNautico::class,'establecimiento_nautico_id','id');
    }
    public function capitania():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Departamento::class,'capitania_id','id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function visita()
    {
        return $this->hasOne(VisitaPermisoEstadia::class);
    }


}
