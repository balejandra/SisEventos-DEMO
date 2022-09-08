<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;


class CoordenadasCapitania extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;


    protected $table = 'coordenadas_capitanias';

    protected $fillable = [
        'capitania_id',
        'latitud',
        'longitud',
        'orden',
    ];

    protected $casts = [
        'capitania_id',
        'latitud',
        'longitud',
        'orden',
    ];

    public function capitania()
    {
        return $this->belongsTo(Departamento::class);
    }

}
