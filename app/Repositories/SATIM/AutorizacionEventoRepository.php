<?php

namespace App\Repositories\SATIM;

use App\Models\SATIM\AutorizacionEvento;
use App\Repositories\BaseRepository;

/**
 * Class AutorizacionEventoRepository
 * @package App\Repositories
 * @version September 13, 2022, 10:25 pm -04
*/

class AutorizacionEventoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nro_solicitud',
        'user_id',
        'nombre_evento',
        'fecha',
        'horario',
        'lugar',
        'cant_organizadores',
        'cant_asistentes',
        'nombre_contacto',
        'telefono_contacto',
        'email_contacto',
        'vigencia',
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
