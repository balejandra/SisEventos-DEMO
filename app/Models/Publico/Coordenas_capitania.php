<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Coordenas_capitania extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    public $table = 'coordenas_capitania';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'capitania_id',
        'latitud',
        'longitud',
        'orden',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'capitania_id',
        'latitud',
        'longitud',
        'orden',
    ];

    public function capitania()
    {
        return $this->belongsTo(Departamento::class,'id','capitania_id');
    }
}
