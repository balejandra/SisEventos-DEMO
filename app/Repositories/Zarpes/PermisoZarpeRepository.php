<?php

namespace App\Repositories\Zarpes;

use App\Models\SATIM\PermisoZarpe;
use App\Repositories\BaseRepository;

/**
 * Class PermisoZarpeRepository
 * @package App\Repositories
 * @version February 20, 2022, 12:22 am UTC
*/

class PermisoZarpeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nro_solicitud',
        'user_id',
        'bandera',
        'matricula',
        'tipo_zarpe_id',
        'establecimiento_nautico_id',
        'coordenadas',
        'destino_capitania_id',
        'fecha_hora_salida',
        'fecha_hora_regreso',
        'status_id',
        'permiso_estadia_id'
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
        return PermisoZarpe::class;
    }
}
