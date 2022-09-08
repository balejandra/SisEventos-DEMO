<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saime_cedula extends Model
{
    use HasFactory;

    public $table = 'saime_cedula';
  protected $connection = 'pgsql_public_schema';
  //protected $connection = 'pgsql_public_prod_schema';


    public $fillable = [
      "tipo_cedula",
      "cedula",
      "sigla1",
      "nombre1",
      "nombre2",
      "apellido1",
      "apellido2",
      "fecha_nacimiento",
      "sexo"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        "tipo_cedula",
        "cedula"=>'string',
        "sigla1",
        "nombre1",
        "nombre2",
        "apellido1",
        "apellido2",
        "fecha_nacimiento"=>'string',
        "sexo"
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo_cedula' => 'required',
        'nombre1' => 'required'
    ];

}
