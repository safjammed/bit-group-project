<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
//        Permission::create(['name' => 'edit articles']);
//        Permission::create(['name' => 'delete articles']);
//        Permission::create(['name' => 'publish articles']);
//        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign created permissions

        // this can be done as separate statements
//        $role = Role::create(['name' => 'user']);
//        $role->givePermissionTo('edit articles');

        // or may be done by chaining
//        $role = Role::create(['name' => 'student']);
//            ->givePermissionTo(['publish articles', 'unpublish articles']);

        $role = Role::create(['name' => 'super-admin']);
        $role = Role::create(['name' => 'administrator']);
        $role = Role::create(['name' => 'student']);
        $role = Role::create(['name' => 'marketing CO']);
        $role = Role::create(['name' => 'project manager']);
        $role = Role::create(['name' => 'director']);
//        $role->givePermissionTo(Permission::all());

    }
}
