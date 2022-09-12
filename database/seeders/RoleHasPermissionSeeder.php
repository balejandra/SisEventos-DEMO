<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Super Admin
        $superadmin_permissions=Permission::all();
        Role::findOrFail(1)->permissions()->sync($superadmin_permissions->pluck('id'));

        //Usuario web

        $user_permissions=Permission::whereIn('name', ['consultar-evento',
             'anular-eventoUsuario','listar-eventos-generados'])->get();
        Role::findOrFail(2)->permissions()->sync($user_permissions->pluck('id'));


         //Admin
        $admin_permissions=$superadmin_permissions->filter(function($permission){
            $name=explode('-', $permission->name);
            if($name[1] == 'usuario' ||  $name[1] == 'Aprobador'){
                return $permission->name;
            }
        });
        Role::findOrFail(3)->permissions()->sync($admin_permissions->pluck('id'));

        //Aprbador
        $aprobador_permissions= Permission::whereIn('name', ['listar-departamento','consultar-departamento',
              'consultar-evento', 'aprobar-evento','rechazar-evento','listar-eventos-todos'])->get();
        Role::findOrFail(4)->permissions()->sync($aprobador_permissions->pluck('id'));

        //Cajero
        $cajero_permissions=Permission::whereIn('name', ['consultar-evento',
             'aprobar-pago','rechazar-pago','listar-evento-porpagar',])->get();
        Role::findOrFail(5)->permissions()->sync($cajero_permissions->pluck('id'));

    }
}
