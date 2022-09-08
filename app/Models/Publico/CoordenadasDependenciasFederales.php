<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoordenadasDependenciasFederales extends Model implements Auditable
{
 
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'coordenadas_dependencias_federales';

    protected $fillable = [
        'dependencias_federales_id',
        'latitud',
        'longitud',
    ];

    protected $casts = [
        'dependencias_federales_id',
        'latitud',
        'longitud',
    ];

    public function dependencias_federales()
    {
        return $this->belongsTo(DependenciaFederal::class);
    }
}
