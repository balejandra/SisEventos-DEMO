<?php

namespace App\Models\SATIM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class DocumentoAutorizacion
 * @package App\Models
 * @version March 10, 2022, 10:35 pm UTC
 *
 * @property unsignedBigInteger $autorizacion_evento_id
 * @property string $recaudo
 * @property string $documento
 */
class DocumentoAutorizacion extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'documentos_autorizaciones';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'autorizacion_evento_id',
        'recaudo',
        'documento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'autorizacion_evento_id' => 'integer',
        'recaudo' => 'string',
        'documento' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'autorizacion_evento_id' => 'required',
        'recaudo' => 'required',
        'documento' => 'required'
    ];
    public function autorizacionevento() {
        return $this->belongsToMany(AutorizacionEvento::class);
    }

}
