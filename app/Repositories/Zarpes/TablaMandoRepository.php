<?php

namespace App\Repositories\Zarpes;

use App\Models\SATIM\TablaMando;
use App\Repositories\BaseRepository;

/**
 * Class TablaMandoRepository
 * @package App\Repositories
 * @version February 19, 2022, 10:15 pm UTC
*/

class TablaMandoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'UAB_minimo',
        'UAB_maximo',
        'cant_tripulantes'
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
        return TablaMando::class;
    }
}
