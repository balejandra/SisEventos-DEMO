<?php

namespace App\Repositories\Publico;

use App\Models\Publico\Menu;
use App\Repositories\BaseRepository;

/**
 * Class MenuRepository
 * @package App\Repositories
 * @version January 15, 2022, 2:48 am UTC
*/

class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'description',
        'url',
        'parent',
        'order',
        'icono',
        'enabled'
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
        return Menu::class;
    }
}
