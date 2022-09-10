<?php

namespace App\Repositories\Zarpes;

use App\Models\SATIM\AutorizacionEvento;
use App\Repositories\BaseRepository;

/**
 * Class PermisoEstadiaRepository
 * @package App\Repositories
 * @version March 10, 2022, 10:25 pm UTC
*/

class PermisoEstadiaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nro_solicitud',
        'user_id',
        'nombre_buque',
        'nro_registro',
        'tipo_buque',
        'nacionalidad_buque',
        'nombre_propietario',
        'nombre_capitan',
        'pasaporte_capitan',
        'cant_tripulantes',
        'puerto_origen',
        'establecimiento_nautico_destino',
        'tiempo_estadia',
        'status_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return AutorizacionEvento::class;
    }
}
