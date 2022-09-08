<?php

namespace App\Models\SATIM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ZarpeRevision
 * @package App\Models
 * @version February 20, 2022, 3:26 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $capitaniaUsers
 * @property unsignedBigInteger $user_id
 * @property unsignedBigInteger $permiso_zarpe_id
 * @property string $accion
 * @property string $motivo
 */
class ZarpeRevision extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'zarpe_revisions';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'permiso_zarpe_id',
        'accion',
        'motivo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'accion' => 'string',
        'motivo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'permiso_zarpe_id' => 'required',
        'accion' => 'required',
        'motivo' => 'required'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function permisozarpe()
    {
        return $this->belongsTo(PermisoZarpe::class);
    }
}
