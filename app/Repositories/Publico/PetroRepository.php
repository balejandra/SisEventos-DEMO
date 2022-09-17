<?php

namespace App\Repositories\Publico;

use App\Models\Publico\Petro;
use App\Repositories\BaseRepository;

/**
 * Class PetroRepository
 * @package App\Repositories
 * @version September 9, 2022, 8:10 pm -04
*/

class PetroRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'nombre',
        'sigla',
        'fecha',
        'monto'
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
        return Petro::class;
    }
}
