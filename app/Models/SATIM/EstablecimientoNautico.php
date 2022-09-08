<?php

namespace App\Models\SATIM;

use App\Models\Publico\Departamento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class EstablecimientoNautico
 * @package App\Models
 *
 * @property string $nombre
 * @property unsignedBigInteger $capitania_id
 * @property string $RIF
 */
class EstablecimientoNautico extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'establecimiento_nauticos';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'nombre',
        'capitania_id',
        'RIF'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'RIF' => 'string'
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

    public function permisozarpe()
    {
        return $this->hasMany(PermisoZarpe::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function capitania()
    {
        return $this->hasMany(Departamento::class);
    }
}
