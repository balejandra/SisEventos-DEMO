<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Tasa
 * @package App\Models
 * @version September 9, 2022, 7:30 pm -04
 *
 * @property string $tipo_actividad
 * @property number $valor
 * @property string $parametro
 */
class Tasa extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'tasas';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'tipo_actividad',
        'valor',
        'parametro'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipo_actividad' => 'string',
        'valor' => 'double',
        'parametro' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo_actividad' => 'required',
        'valor' => 'required',
        'parametro' => 'required'
    ];


}
