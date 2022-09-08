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
        
        $user_permissions=Permission::whereIn('name', ['consultar-zarpe',
              'informar-arribo','informar-navegacion','anular-zarpeUsuario','listar-zarpesgenerados'])->get();
        Role::findOrFail(2)->permissions()->sync($user_permissions->pluck('id'));
        
        
         //Admin
        $admin_permissions=$superadmin_permissions->filter(function($permission){
            $name=explode('-', $permission->name);
            if($name[1] == 'usuario' ||  $name[1] == 'capitania'){
                return $permission->name;
            }
        });
        Role::findOrFail(3)->permissions()->sync($admin_permissions->pluck('id'));

        //Capitan
        $capitan_permissions= Permission::whereIn('name', ['listar-capitania','consultar-capitania',
              'consultar-zarpe', 'aprobar-zarpe','rechazar-zarpe','anular-sar','listar-zarpes-capitania-origen','listar-zarpe-destino'])->get();
        Role::findOrFail(4)->permissions()->sync($capitan_permissions->pluck('id'));

        //comodoro_aprobador
        $comodoro_aprobador_permissions=Permission::whereIn('name', ['consultar-zarpe',
             'aprobar-zarpe','rechazar-zarpe','informar-navegacion','anular-sar','listar-zarpes-establecimiento-origen'])->get();
        Role::findOrFail(5)->permissions()->sync($comodoro_aprobador_permissions->pluck('id'));

        //comodoro
        $comodoro_permissions=Permission::whereIn('name', ['consultar-zarpe',
              'informar-navegacion','anular-sar','listar-zarpes-establecimiento-origen'])->get();
        Role::findOrFail(6)->permissions()->sync($comodoro_permissions->pluck('id'));


        //agencia naviera
        $agencia_naviera=Permission::whereIn('name', ['crear-estadia',
              'recaudos-estadia','listar-estadia-generados'])->get();
        Role::findOrFail(7)->permissions()->sync($agencia_naviera->pluck('id'));

    }
}
