<?php

namespace App\Repositories\Publico;


use App\Models\Publico\Departamento;
use App\Repositories\BaseRepository;

/**
 * Class CapitaniaRepository
 * @package App\Repositories
 * @version January 19, 2022, 11:00 pm UTC
*/

class DepartamentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'sigla'
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
        return Departamento::class;
    }
}
