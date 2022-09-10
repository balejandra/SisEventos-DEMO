<?php

namespace App\Models\SATIM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PagoEvento
 * @package App\Models
 * @version September 9, 2022, 7:53 pm -04
 *
 * @property integer $autorizacion_evento_id
 * @property number $monto_pagar_petros
 * @property number $monto_pagar_bolivares
 * @property string $forma_pago
 * @property string $codigo_transaccion
 * @property string $fecha_pago
 */
class PagoEvento extends Model  implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'pagos_eventos';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'autorizacion_evento_id',
        'monto_pagar_petros',
        'monto_pagar_bolivares',
        'forma_pago',
        'codigo_transaccion',
        'fecha_pago'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'autorizacion_evento_id' => 'integer',
        'monto_pagar_petros' => 'double',
        'monto_pagar_bolivares' => 'double',
        'forma_pago' => 'string',
        'codigo_transaccion' => 'string',
        'fecha_pago' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'autorizacion_evento_id' => 'required',
        'monto_pagar_petros' => 'required',
        'monto_pagar_bolivares' => 'required',
        'fecha_pago' => 'required'
    ];

    public function autorizacionevento() {
        return $this->belongsToMany(AutorizacionEvento::class);
    }

}
