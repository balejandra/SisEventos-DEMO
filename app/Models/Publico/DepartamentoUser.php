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
 * @property string $cargo_id
 * @property string $user_id
 * @property string $departamento_id
 * @property boolean $habilitado
 */
class DepartamentoUser extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'capitania_user';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'cargo_id',
        'user_id',
        'departamento_id',
        'habilitado'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cargo_id' => 'string',
        'user_id' => 'string',
        'departamento_id' => 'string',
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
        'departamento_id' => 'required',
        'habilitado'=>'required'
    ];

    public function departamento():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Departamento::class,'departamento_id','id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function cargos(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class,'cargo_id','id');
    }
}
