<?php

namespace App\Models\Publico;

use App\Models\User;
use App\Models\Publico\Departamento;
use App\Models\SATIM\EstablecimientoNautico;
use App\Models\SATIM\ZarpeRevision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Role;

/**
 * Class CapitaniaUser
 * @package App\Models
 * @version February 19, 2022, 9:36 pm UTC
 *
 * @property string $cargo
 * @property string $user_id
 * @property string $capitania_id
 * @property string $establecimiento_nautico_id
 * @property boolean $habilitado
 */
class CapitaniaUser extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'capitania_user';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cargo',
        'user_id',
        'capitania_id',
        'establecimiento_nautico_id',
        'habilitado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cargo' => 'string',
        'user_id' => 'string',
        'capitania_id' => 'string',
        'establecimiento_nautico_id'=>'string',
        'habilitado'=>'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cargo' => 'required',
        'user_id' => 'required',
        'capitania_id' => 'required',
        'habilitado'=>'required'
    ];

    public function capitania():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Departamento::class,'capitania_id','id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function cargos(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class,'cargo','id');
    }
    public function establecimientos()
    {
        return $this->belongsTo(EstablecimientoNautico::class,'establecimiento_nautico_id');
    }

    public function zarperevision(){
        return $this->hasMany(ZarpeRevision::class);
    }
}
