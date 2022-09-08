<?php

namespace App\Models\SATIM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Notificacione extends Model  implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'notificaciones';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'user_id',
        'titulo',
        'texto',
        'internacional',
        'permiso_zarpe_id'
    ];


    protected $casts = [
        'id' => 'integer',
        'titulo'=>'string',
        'texto'=>'string',
        'internacional'=>'boolean'

    ];


    public static $rules = [
        'user_id' => 'required',
        'titulo' => 'required',
        'texto' => 'required',
        'internacional'=>'required',
        'permiso_zarpe_id' => 'required',

    ];

    public function permisozarpes() {
        return $this->belongsToMany(PermisoZarpe::class);
    }


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
