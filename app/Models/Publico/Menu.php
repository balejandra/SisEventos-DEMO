<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use OwenIt\Auditing\Contracts\Auditable;



/**
 * Class Menu
 * @package App\Models
 * @version January 15, 2022, 2:48 am UTC
 *
 * @property string $name
 * @property string $description
 * @property string $url
 * @property integer $parent
 * @property integer $order
 * @property string $icono
 * @property boolean $enabled
 */
class Menu extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'menus';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'description',
        'url',
        'parent',
        'order',
        'icono',
        'enabled'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'url' => 'string',
        'parent' => 'integer',
        'order' => 'integer',
        'icono' => 'string',
        'enabled' => 'boolean'
    ];

    public function menus_roles()
    {
        return $this->belongsToMany(Menu_rol::class,'menus_roles','menu_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menus_roles');
    }

    public function getPadres($front)
    {
        if ($front) {
            return $this->whereHas('roles', function ($query) {
                $query->where('role_id', Auth::user()->roles()->first()['id']);
            })
                ->where('enabled',true)
                ->orderby('parent')
                ->orderby('order')
                ->get()
                ->toArray();
        } else {
            return $this->orderby('menu_id')
                ->where('enabled',true)
                ->orderby('order')
                ->get()
                ->toArray();
        }
    }

    public function getHijos($data, $line)
    {
        $children = [];
        foreach ($data as $line1) {

            if ($line['id'] == $line1['parent']) {
                $children = array_merge($children, [ array_merge($line1, ['submenu' => $this->getHijos($data, $line1) ]) ]);
            }
        }
        return $children;
    }
    public function optionsMenu()
    {
        return $this->where('enabled', 1)
            ->orderby('parent')
            ->orderby('order')
            ->orderby('name')
            ->get()
            ->toArray();
    }
    public static function getMenu($front = false)
    {
        $menus = new Menu();
        $data = $menus->getPadres($front);

        $menuAll = [];
        foreach ($data as $line) {
            $item = [ array_merge($line, ['submenu' => $menus->getHijos($data, $line) ]) ];
            $menuAll = array_merge($menuAll, $item);
        }
        return $menus->menuAll = $menuAll;
    }
}
