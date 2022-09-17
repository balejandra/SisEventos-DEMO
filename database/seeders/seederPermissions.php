<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//spatie
use Spatie\Permission\Models\Permission;

class seederPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            //Permisos para users
            'listar-usuario',
            'crear-usuario',
            'editar-usuario',
            'consultar-usuario',
            'eliminar-usuario',

            //permisos para roles
            'listar-rol',
            'crear-rol',
            'editar-rol',
            'consultar-rol',
            'eliminar-rol',

            //Permisos para permisos
            'listar-permiso',
            'crear-permiso',
            'editar-permiso',
            'consultar-permiso',
            'eliminar-permiso',

            //Permisos para menus
            'listar-menu',
            'crear-menu',
            'editar-menu',
            'consultar-menu',
            'eliminar-menu',

            //Permisos para departamentos
            'listar-departamento',
            'crear-departamento',
            'editar-departamento',
            'consultar-departamento',
            'eliminar-departamento',

            //Permisos para Status
            'listar-status',
            'crear-status',
            'editar-status',
            'consultar-status',
            'eliminar-status',

            //Permisos para permisos de eventos
            'consultar-evento',
            'aprobar-evento',
            'rechazar-evento',
            'informar-arribo',
            'informar-navegacion',
            'anular-sar',
            'anular-eventoUsuario',
            'listar-eventos-todos', //admin
            'listar-eventos-generados',//usuariosweb
            'aprobar-pago',
            'rechazar-pago',//comodoros
            'listar-evento-porpagar', //comodoro, capitan, comodoro_aprovador

              //permisos para usuarios de departamentos
            'listar-usuarios-departamentos',
            'crear-usuarios-departamentos',
            'consultar-usuarios-departamentos',
            'editar-usuarios-departamentos',
            'eliminar-usuarios-departamentos',

            //permisos para Auditoria
            'listar-auditoria',
            'consultar-auditoria',

            //permisos para Notificaciones
            'consultar-notificaciones',
            'listar-notificaciones',

            //Permisos para tasas
            'listar-tasas',
            'crear-tasas',
            'editar-tasas',
            'consultar-tasas',
            'eliminar-tasas',

            //Permisos para petros
            'listar-petros',
            'crear-petros',
            'editar-petros',
            'consultar-petros',
            'eliminar-petros',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name'=>$permission]);
        }
    }
}
