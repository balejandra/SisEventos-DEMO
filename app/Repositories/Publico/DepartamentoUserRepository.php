<?php

namespace App\Repositories\Publico;

use App\Models\Publico\DepartamentoUser;
use App\Repositories\BaseRepository;

/**
 * Class CapitaniaUserRepository
 * @package App\Repositories
 * @version February 19, 2022, 9:36 pm UTC
*/

class DepartamentoUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'cargo',
        'user_id',
        'capitania_id'
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
        return DepartamentoUser::class;
    }
}
