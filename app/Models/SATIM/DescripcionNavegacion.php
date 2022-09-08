<?php

namespace App\Models\SATIM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DescripcionNavegacion extends Model
{

    use SoftDeletes;
    use HasFactory;


    protected $connection = 'pgsql_zarpes_schema';
    public $table = 'descripcion_navegacion';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'descripcion'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'descripcion' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcion' => 'required'
    ];

    public function permisozarpe()
    {
        return $this->hasOne(PermisoZarpe::class);
    }

}
