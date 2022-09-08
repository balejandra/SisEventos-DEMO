<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Paise extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'paises';
    protected $connection = 'pgsql_public_schema';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'iso',
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'iso' => 'string',
        'name' => 'string',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'iso' => 'required',
        'name' => 'required',
    ];
}
