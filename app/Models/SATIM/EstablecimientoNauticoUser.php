<?php

namespace App\Models\SATIM;

use App\Models\Publico\CapitaniaUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class EstablecimientoNauticoUser
 * @package App\Models
 * @version February 19, 2022, 9:36 pm UTC
 *
 * @property string $user_id
 * @property string $establecimiento_nautico_id
 * @property string $capitania_user_id
 */
class EstablecimientoNauticoUser extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'establecimiento_nautico_user';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'establecimiento_nautico_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'string',
        'establecimiento_nautico_id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'establecimiento_nautico_id' => 'required'
    ];

    public function establecimientos()
    {
        return $this->hasMany(EstablecimientoNautico::class);
    }
    public function user()
    {
        return $this->hasMany(User::class,'id','user_id');
    }
    public function zarperevision(){
        return $this->hasMany(ZarpeRevision::class);
    }
    public function establecimiento_user(){
        return $this->belongsTo(CapitaniaUser::class,'capitania_user_id','id');

    }
}
