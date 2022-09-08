<?php

namespace App\Models\Publico;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;
use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class Menu_rol
 * @package App\Models
 * @version January 15, 2022, 11:57 pm UTC
 *
 * @property integer $role_id
 * @property integer $menu_id
 */
class Menu_rol extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public $table = 'menus_roles';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'role_id',
        'menu_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role_id' => 'integer',
        'menu_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'role_id' => 'required',
        'menu_id' => 'required'
    ];

    /**
     * @return BelongsToMany
     **/
    public function menus()
    {
        return $this->belongsToMany(Menu::class,'menus_roles','menu_id')->withPivot('name');
    }

    /**
     * @return BelongsToMany
     **/
    public function roles()
    {
        return $this->belongsToMany(Role::class,'menus_roles','role_id','menu_id')->withPivot('name');;
    }

}
