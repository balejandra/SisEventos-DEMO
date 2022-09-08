<?php

namespace App\Models\SATIM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class DocumentoPermisoEstadia
 * @package App\Models
 * @version March 10, 2022, 10:35 pm UTC
 *
 * @property unsignedBigInteger $permiso_estadia_id
 * @property string $recaudo
 * @property string $documento
 */
class DocumentoPermisoEstadia extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'documento_permiso_estadia';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'permiso_estadia_id',
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
        'permiso_estadia_id' => 'integer',
        'recaudo' => 'string',
        'documento' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'permiso_estadia_id' => 'required',
        'recaudo' => 'required',
        'documento' => 'required'
    ];
    public function permisoestadia() {
        return $this->belongsToMany(PermisoEstadia::class);
    }

}
