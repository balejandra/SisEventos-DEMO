<?php

namespace App\Models\SATIM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class EquipoPermisoZarpe
 * @package App\Models
 * @version February 20, 2022, 3:06 am UTC
 *
 * @property unsignedBigInteger $permiso_zarpe_id
 * @property unsignedBigInteger $equipo_id
 */
class EquipoPermisoZarpe extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'equipo_permiso_zarpe';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'permiso_zarpe_id',
        'equipo_id',
        'cantidad',
        'otros',
        'valores_otros'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cantidad'=>'string',
        'otros'=>'string',
        'valores_otros'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'permiso_zarpe_id' => 'required',
        'equipo_id' => 'required'
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
