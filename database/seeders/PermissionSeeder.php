<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Permission\Models\Role;
use App\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rolAdmin = Role::create([
            'name' => 'Administrador',
            'slug' => 'admin',
            'description' => 'Administrador',
            'full-access' => 'no'
        ]);
        $rolAgente = Role::create([
            'name' => 'Agente',
            'slug' => 'agente',
            'description' => 'agente',
            'full-access' => 'no'
        ]);
        $rolBrigadista = Role::create([
            'name' => 'Brigadista',
            'slug' => 'brigadista',
            'description' => 'bdigadista',
            'full-access' => 'no'
        ]);


        $user1 = User::find(1);
        $user2 = User::find(2);

        $user1->roles()->sync([$rolAdmin->id]);
        $user2->roles()->sync([$rolAdmin->id]);

        //permisos
        $permission_all = [];
        $permission_agn = [];
        $permission_adm = [];
        $permission_brig = [];


        ///////////////permisos para Usuarios//////////////////////////////////////////////////////////////////////////
        $permission = Permission::create([
            'name' => 'Agente',
            'slug' => 'agente.perm',
            'description' => 'El usuario es un Agente'
        ]);
        $permission_all[] = $permission->id;
        $permission_agn[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Admin',
            'slug' => 'admin.perm',
            'description' => 'El usuario es un Admin'
        ]);
        $permission_all[] = $permission->id;
        $permission_adm[] = $permission->id;

        $permission = Permission::create([
            'name' => 'Brig',
            'slug' => 'brig.perm',
            'description' => 'El usuario es un Brigadista'
        ]);
        $permission_all[] = $permission->id;
        $permission_brig[] = $permission->id;

        $rolAdmin->permissions()->sync($permission_adm);
        $rolAgente->permissions()->sync($permission_agn);
        $rolBrigadista->permissions()->sync($permission_brig);
    }
}