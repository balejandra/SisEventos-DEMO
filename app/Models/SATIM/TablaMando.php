<?php

namespace App\Models\SATIM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class TablaMando
 * @package App\Models
 * @version February 19, 2022, 10:15 pm UTC
 *
 * @property string $UAB_minimo
 * @property string $UAB_maximo
 * @property string $cant_tripulantes
 */
class TablaMando extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'tabla_mandos';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'UAB_minimo',
        'UAB_maximo',
        'cant_tripulantes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'UAB_minimo' => 'string',
        'UAB_maximo' => 'string',
        'cant_tripulantes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'UAB_minimo' => 'required',
        'UAB_maximo' => 'required',
        'cant_tripulantes' => 'required'
    ];

    public function cargotablamandos(){
        return $this->hasMany(CargoTablaMando::class);
    }
}
