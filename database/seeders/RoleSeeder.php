<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles y Permisos
        $admin = Role::create(['name'=>'admin']);
        $jefeEnfermeria= Role::create(['name'=>'Jefe de Enfermeria']);
        $lic =Role::create(['name'=>'Licenciado de Turno']);


        //USUARIOS PERMISOS 
        Permission::create(['name'=>'dashboard'])->syncRoles($admin, $jefeEnfermeria, $lic);
        Permission::create(['name'=>'users'])->syncRoles($admin);
        Permission::create(['name'=>'storage'])->syncRoles($jefeEnfermeria);
        Permission::create(['name'=>'products'])->syncRoles($jefeEnfermeria, $lic);
        Permission::create(['name'=>'reports'])->syncRoles($admin);
        Permission::create(['name'=>'sales'])->syncRoles($jefeEnfermeria, $lic);

        Permission::create(['name'=>'laboratorio'])->syncRoles($admin, $jefeEnfermeria);
        

        //CATEGORIAS PERMISOS
        Permission::create(['name'=>'agregar_categoria'])->syncRoles($admin, $jefeEnfermeria);
        Permission::create(['name'=>'editar_categoria'])->syncRoles($admin, $jefeEnfermeria);
        Permission::create(['name'=>'eliminar_categoria'])->syncRoles($admin, $jefeEnfermeria);

        //ESPECIALIDADES PERMISOS
        Permission::create(['name'=>'crear_especialidad'])->syncRoles($admin, $jefeEnfermeria, $lic);
        Permission::create(['name'=>'editar_especialidad'])->syncRoles($admin, $jefeEnfermeria);
        Permission::create(['name'=>'eliminar_especialidad'])->syncRoles($admin, $jefeEnfermeria);

        //Productos
        Permission::create(['name'=>'agregar_producto'])->syncRoles($admin, $jefeEnfermeria);
        Permission::create(['name'=>'editar_producto'])->syncRoles($admin, $jefeEnfermeria);
        Permission::create(['name'=>'eliminar_producto'])->syncRoles($admin, $jefeEnfermeria);
        Permission::create(['name'=>'incrementar_producto'])->syncRoles($admin, $jefeEnfermeria);
    }
}
