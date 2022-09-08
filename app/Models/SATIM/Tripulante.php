<?php

namespace App\Models\SATIM;

use App\Models\Gmar\LicenciasTitulosGmar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Tripulante
 * @package App\Models
 * @version February 20, 2022, 2:36 am UTC
 *
 * @property unsignedBigInteger $permiso_zarpe_id
 * @property string $ctrl_documento_id
 * @property boolean $capitan
 */
class Tripulante extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'tripulantes';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'permiso_zarpe_id',
        'ctrl_documento_id',
        'capitan',
        'funcion',
        'nombres',
        'apellidos',
        'tipo_doc',
        'nro_doc',
        'doc',
        'rango',
        'fecha_nacimiento',
        'sexo',
        'documento_acreditacion',
        'fecha_emision',
        'nro_ctrl'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'permiso_zarpe_id'=>'integer',
        'ctrl_documento_id' => 'string',
        'capitan' => 'boolean',
        'funcion' => 'string',
        'nombres' => 'string',
        'apellidos' => 'string',
        'tipo_doc' => 'string',
        'nro_doc' => 'string',
        'doc' => 'string',
        'rango' => 'string',
        'fecha_nacimiento'=> 'string',
        'sexo'=> 'string',
        'documento_acreditacion'=> 'string',
        'fecha_emision'=>'string',
        'nro_ctrl'=>'string'

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'permiso_zarpe_id' => 'required',
        'ctrl_documento_id' => 'required',
        'capitan' => 'required',
        'funcion' => 'required',
        'nombres' => 'required',
        'apellidos' => 'required',
        'tipo_doc' => 'required',
        'nro_doc' => 'required',
        'doc' => 'required',
        'rango' => 'required',
        'fecha_nacimiento'=> 'required',
        'sexo'=> 'required',
        'documento_acreditacion'=> 'required',

    ];

    public function permisozarpe()
    {
        return $this->belongsTo(PermisoZarpe::class);
    }

    public function licencias_titulos_gmar()
    {
        return $this->belongsTo(LicenciasTitulosGmar::class,'ctrl_documento_id','nro_ctrl');
    }

}

