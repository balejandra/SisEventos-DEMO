<?php

namespace App\Repositories\Publico;

use App\Models\Publico\Menu_rol;
use App\Repositories\BaseRepository;

/**
 * Class Menu_rolRepository
 * @package App\Repositories
 * @version January 15, 2022, 11:57 pm UTC
*/

class Menu_rolRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'role_id',
        'menu_id'
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
        return Menu_rol::class;
    }
}
