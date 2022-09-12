<?php

namespace App\Repositories\Publico;

use App\Models\Publico\Tasa;
use App\Repositories\BaseRepository;

/**
 * Class TasaRepository
 * @package App\Repositories
 * @version September 9, 2022, 7:30 pm -04
*/

class TasaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'tipo_actividad',
        'valor',
        'parametro'
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
        return Tasa::class;
    }
}
