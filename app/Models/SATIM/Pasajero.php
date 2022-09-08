<?php

namespace App\Models\SATIM;

use App\Models\SATIM\PermisoZarpe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Pasajero
 * @package App\Models
 * @version February 20, 2022, 2:56 am UTC
 *
 * @property string $nombres
 * @property string $apellidos
 * @property string $tipo_doc
 * @property string $nro_doc
 * @property string $sexo
 * @property string $fecha_nacimiento
 * @property boolean $menor_edad
 * @property unsignedBigInteger $permiso_zarpe_id
 */
class Pasajero extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'pasajeros';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombres',
        'apellidos',
        'tipo_doc',
        'nro_doc',
        'sexo',
        'fecha_nacimiento',
        'menor_edad',
        'permiso_zarpe_id',
        'representante',
        'partida_nacimiento',
        'autorizacion',
        'pasaporte_menor',
        'pasaporte_mayor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombres' => 'string',
        'apellidos' => 'string',
        'tipo_doc' => 'string',
        'nro_doc' => 'string',
        'sexo' => 'string',
        'fecha_nacimiento' => 'date',
        'menor_edad' => 'boolean',
        'representante'=> 'string',
        'partida_nacimiento'=> 'string',
        'autorizacion'=> 'string',
        'pasaporte_menor'=> 'string',
        'pasaporte_mayor'=> 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombres' => 'required',
        'apellidos' => 'required',
        'tipo_doc' => 'required',
        'nro_doc' => 'required',
        'sexo' => 'required',
        'fecha_nacimiento' => 'required',
        'menor_edad' => 'required',
        'permiso_zarpe_id' => 'required',
        'representante'=> 'required',
        'partida_nacimiento'=> 'required',
        'autorizacion'=> 'required',
        'pasaporte_menor'=> 'required',
        'pasaporte_mayor'=> 'required',
    ];

    public function permisozarpe()
    {
        return $this->belongsTo(PermisoZarpe::class);
    }
}
