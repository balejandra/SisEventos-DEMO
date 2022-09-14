<?php

namespace App\Models\SATIM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Notificacion extends Model  implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_public_schema';
    public $table = 'notificaciones';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'titulo',
        'texto',
        'tipo',
        'visto'
    ];

    protected $casts = [
        'id' => 'integer',
        'titulo'=>'string',
        'texto'=>'string',
        'tipo'=>'string',
        'visto'=>'boolean'

    ];

    public static $rules = [
        'user_id' => 'required',
        'titulo' => 'required',
        'texto' => 'required',
        'tipo'=>'required',
        'visto' => 'required',

    ];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
