<?php

namespace App\Models\SATIM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class EstadiaRevision
 * @package App\Models
 * @version March 10, 2022, 10:31 pm UTC
 *
 * @property unsignedBigInteger $user_id
 * @property unsignedBigInteger $permiso_estadia_id
 * @property string $accion
 * @property string $motivo
 */
class EstadiaRevision extends Model implements Auditable
{
    use SoftDeletes;
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'estadia_revisiones';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'permiso_estadia_id',
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
        'user_id' => 'integer',
        'permiso_estadia_id' => 'integer',
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
        'permiso_estadia_id' => 'required',
        'accion' => 'required',
        'motivo' => 'required'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function permisoestadia()
    {
        return $this->belongsTo(PermisoEstadia::class);
    }

}
