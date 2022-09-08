<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class DependenciaFederal
 * @package App\Models
 * @version March 22, 2022, 1:53 pm UTC
 *
 * @property string $nombre
 * @property integer $capitania_id
 */
class DependenciaFederal extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'dependencias_federales';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'capitania_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'capitania_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'capitania_id' => 'required'
    ];


}
