<?php

namespace App\Models\SATIM;

use App\Models\Publico\Departamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CargoTablaMando
 * @package App\Models
 *
 * @property \Illuminate\Database\Eloquent\Collection $tablaMandos
 * @property string $cargo_desempena
 * @property string $titulacion_aceptada_minima
 * @property string $titulacion_aceptada_maxima
 * @property unsignedBigInteger $tabla_mando_id
 */
class CargoTablaMando extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'cargo_tabla_mandos';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cargo_desempena',
        'titulacion_aceptada_minima',
        'titulacion_aceptada_maxima',
        'tabla_mando_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cargo_desempena' => 'string',
        'titulacion_aceptada_minima' => 'string',
        'titulacion_aceptada_maxima' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cargo_desempena' => 'required',
        'titulacion_aceptada_minima' => 'required',
        'titulacion_aceptada_maxima' => 'required',
        'tabla_mando_id' => 'required'
    ];

    public function capitania()
    {
        return $this->hasOne(Departamento::class);
    }
}
