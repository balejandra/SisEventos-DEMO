<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Petro
 * @package App\Models
 * @version September 9, 2022, 8:10 pm -04
 *
 * @property string $nombre
 * @property string $sigla
 * @property string $fecha
 * @property number $monto
 */
class Petro extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'petros';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'sigla',
        'fecha',
        'monto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'sigla' => 'string',
        'fecha' => 'date',
        'monto' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'sigla' => 'required',
        'fecha' => 'required',
        'monto' => 'required'
    ];


}
