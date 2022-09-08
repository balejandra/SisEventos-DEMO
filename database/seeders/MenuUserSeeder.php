<?php

namespace Database\Seeders;

use App\Models\Publico\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /////CONFIG/////////
        $menuConfig = Menu::create([
            'name' => 'Configuracion',
            'url' => 'home',
            'order' => '0',
            'parent' => '0',
            'icono'=>'icon-settings',
        ]);

        $menuRols = [
            array('role_id' => '1', 'menu_id' => $menuConfig['id']),
        ];
        DB::table('menus_roles')->insert($menuRols);


        $menu2 = Menu::create([
            'name' => 'Menus',
            'url' => 'menus',
            'order' => '0',
            'parent' => $menuConfig['id'],
            'icono'=>'icon-menu',
        ]);

        $menuRols3 = [
            array('role_id' => '1', 'menu_id' => $menu2['id']),
        ];
        DB::table('menus_roles')->insert($menuRols3);


        $permiso = Menu::create([
            'name' => 'Permisos',
            'url' => 'permissions',
            'order' => '1',
            'parent' => $menuConfig['id'],
            'icono'=>'icon-lock',
        ]);

        $menuRols4 = [
            array('role_id' => '1', 'menu_id' => $permiso['id']),
        ];
        DB::table('menus_roles')->insert($menuRols4);

        $roles = Menu::create([
            'name' => 'Roles',
            'url' => 'roles',
            'order' => '2',
            'parent' => $menuConfig['id'],
            'icono'=>'icon-list',
        ]);

        $menuRols5 = [
            array('role_id' => '1', 'menu_id' => $roles['id']),
        ];
        DB::table('menus_roles')->insert($menuRols5);

        $auditoria = Menu::create([
            'name' => 'Auditorias',
            'url' => 'auditables',
            'order' => '3',
            'parent' => $menuConfig['id'],
            'icono'=>'fas fa-history',
        ]);

        $menuRols6 = [
            array('role_id' => '1', 'menu_id' => $auditoria['id']),
        ];
        DB::table('menus_roles')->insert($menuRols6);


/////PUBLICO///////
        $menuPublico = Menu::create([
            'name' => 'Publico',
            'url' => 'home',
            'order' => '1',
            'parent' => '0',
            'icono'=>'icon-globe',
        ]);

        $menuRols1 = [
            array('role_id' => '1', 'menu_id' => $menuPublico['id']),
        ];
        DB::table('menus_roles')->insert($menuRols1);

        $user = Menu::create([
            'name' => 'Usuarios',
            'url' => 'users',
            'order' => '0',
            'parent' => $menuPublico['id'],
            'icono'=>'icon-user',
        ]);

        $menupubli = [
            array('role_id' => '1', 'menu_id' => $user['id']),
        ];
        DB::table('menus_roles')->insert($menupubli);

        $capitania = Menu::create([
            'name' => 'Capitanias',
            'url' => 'capitanias',
            'order' => '1',
            'parent' => $menuPublico['id'],
            'icono'=>'icon-organization',
        ]);

        $menupubli1 = [
            array('role_id' => '1', 'menu_id' => $capitania['id']),
        ];
        DB::table('menus_roles')->insert($menupubli1);
    }
}
