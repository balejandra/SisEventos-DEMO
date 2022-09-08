<?php

namespace App\Models\SATIM;

use App\Models\Publico\Paise;
use App\Models\Publico\Departamento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PermisoZarpe
 * @package App\Models
 * @version February 20, 2022, 12:22 am UTC
 *
 * @property string $nro_solicitud
 * @property unsignedBigInteger $user_id
 * @property string $bandera
 * @property string $matricula
 * @property unsignedBigInteger $tipo_zarpe_id
 * @property unsignedBigInteger $establecimiento_nautico_id
 * @property string $coordenadas
 * @property unsignedBigInteger $destino_capitania_id
 * @property string $fecha_hora_salida
 * @property string $fecha_hora_regreso
 * @property unsignedBigInteger $status_id
 * @property unsignedBigInteger $permiso_estadia_id
 */
class PermisoZarpe extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'permiso_zarpes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nro_solicitud',
        'user_id',
        'bandera',
        'matricula',
        'tipo_zarpe_id',
        'establecimiento_nautico_id',
        'coordenadas',
        'destino_capitania_id',
        'fecha_hora_salida',
        'fecha_hora_regreso',
        'status_id',
        'establecimiento_nautico_destino_id',
        'descripcion_navegacion_id',
        'permiso_estadia_id',
        'fecha_llegada_escala',
        'paises_id',
        'establecimiento_nautico_destino_zi'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nro_solicitud' => 'string',
        'bandera' => 'string',
        'matricula' => 'string',
        'coordenadas' => 'string',
        'fecha_hora_salida' => 'datetime',
        'fecha_hora_regreso' => 'datetime',
         'user_id' => 'integer',
         'establecimiento_nautico_destino_id'=> 'integer',
        'descripcion_navegacion_id'=> 'integer',
        'permiso_estadia_id'=>'integer',
        'fecha_llegada_escala'=>'datetime',
        'paises_id'=>'integer',
        'establecimiento_nautico_destino_zi'=> 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nro_solicitud' => 'required',
        'user_id' => 'required',
        'bandera' => 'required',
        'matricula' => 'required',
        'tipo_zarpe_id' => 'required',
        'establecimiento_nautico_id' => 'required',
        'coordenadas' => 'required',
        'destino_capitania_id' => 'required',
        'fecha_hora_salida' => 'required',
        'fecha_hora_regreso' => 'required',
        'status_id' => 'required',
        'establecimiento_nautico_destino_id'=> 'integer',
        'descripcion_navegacion_id'=> 'integer',
        'paises_id'=>'integer'

    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tipo_zarpe():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TipoZarpe::class);
    }

    public function establecimiento_nautico()
    {
        return $this->belongsTo(EstablecimientoNautico::class);
    }

    public function capitania():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Departamento::class,'destino_capitania_id','id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function tripulantes(){
        return $this->hasMany(Tripulante::class);
    }

    public function pasajeros(){
        return $this->hasMany(Pasajero::class);
    }

    public function equipos() {
        return $this->belongsToMany(Equipo::class);
    }

    public function zarperevisions(){
        return $this->hasMany(ZarpeRevision::class);
    }

    public function descripcion_navegacion():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DescripcionNavegacion::class);
    }

    public function paises()
    {
        return $this->belongsTo(Paise::class);
    }

}
