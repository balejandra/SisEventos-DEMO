<?php

namespace App\Models\SATIM;

use App\Models\Publico\Departamento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AutorizacionEvento
 * @package App\Models
 * @version March 10, 2022, 10:25 pm UTC
 *

 */
class AutorizacionEvento extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_public_schema';
    public $table = 'autorizaciones_eventos';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nro_solicitud',
        'user_id',
        'nombre_evento',
        'fecha',
        'horario',
        'lugar',
        'cant_organizadores',
        'cant_asistentes',
        'nombre_contacto',
        'telefono_contacto',
        'email_contacto',
        'vigencia',
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
        'user_id' => 'integer',
        'nombre_evento' => 'string',
        'fecha' => 'date',
        'horario' => 'time',
        'lugar' => 'string',
        'cant_organizadores' => 'integer',
        'cant_asistentes' => 'integer',
        'nombre_contacto'=> 'string',
        'telefono_contacto'=> 'string',
        'email_contacto'=> 'string',
        'vigencia' => 'string',
        'status_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nro_solicitud' => 'required',
        'user_id' => 'required',
        'nombre_evento' => 'required',
        'fecha' => 'required',
        'horario' => 'required',
        'lugar' => 'required',
        'cant_organizadores' => 'required',
        'cant_asistentes' => 'required',
        'nombre_contacto'=> 'required',
        'telefono_contacto'=> 'required',
        'email_contacto'=> 'required',
    ];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
