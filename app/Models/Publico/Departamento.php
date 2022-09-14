<?php

namespace App\Models\Publico;

use App\Models\User;
use App\Models\SATIM\EstablecimientoNautico;
use App\Models\SATIM\PermisoZarpe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Departamento
 * @package App\Models
 * @version January 19, 2022, 11:00 pm UTC
 *
 * @property string $nombre
 * @property string $sigla
 * @property string $unidad_inmediata_superior
 */
class Departamento extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    protected $connection = 'pgsql_public_schema';
    public $table = 'departamentos';


    protected $dates = ['deleted_at'];

    public $fillable = [
        'nombre',
        'sigla',
        'unidad_inmediata_superior'
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
        'unidad_inmediata_superior'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nombre' => 'required',
        'sigla' => 'required',
        'unidad_inmediata_superior'=>'required'
    ];


    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
