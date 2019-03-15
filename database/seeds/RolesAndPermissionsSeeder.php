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
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'define user roles']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'modify users']);
        Permission::create(['name' => 'assign permissions']);
        Permission::create(['name' => 'assign marketing coordinator']);
//        Permission::create(['name' => 'assign student to faculty']);
        Permission::create(['name' => 'edit system data']);

        Permission::create(['name' => 'add faculty']);
        Permission::create(['name' => 'modify faculty']);
        Permission::create(['name' => 'view faculties']);
        Permission::create(['name' => 'view faculty details']);
        Permission::create(['name' => 'make comment on article']);
        Permission::create(['name' => 'add article and pictures']);
        Permission::create(['name' => 'modify articles and pictures']);
        Permission::create(['name' => 'view articles and pictures']);

        Permission::create(['name' => 'download article']);
        Permission::create(['name' => 'contact faculty student']);
        Permission::create(['name' => 'select articles for publication']);
        Permission::create(['name' => 'unselect articles for publication']);
        Permission::create(['name' => 'view selected articles']);



        Role::create(['name' => 'administrator'])->givePermissionTo([
            'add user',
            'define user roles',
            'view users',
            'modify users',
            'assign permissions',
            'assign marketing coordinator',
            'edit system data',
            'add faculty',
            'modify faculty',
            'view faculties',
            'view faculty details',
        ]);

        Role::create(['name' => 'student'])->givePermissionTo([
            'add article and pictures',
            'modify articles and pictures',
            'view faculties',
            'view faculty details',
            'view articles and pictures'
        ]);

        Role::create(['name' => 'marketing coordinator'])->givePermissionTo([
            'download article',
            'view faculties',
            'view selected articles',
            'select articles for publication',
            'unselect articles for publication',
            'contact faculty student',
            'view articles and pictures'
        ]);

        Role::create(['name' => 'marketing manager'])->givePermissionTo([
            'download article',
            'view faculties',
            'view faculty details',
            'view selected articles',
            'select articles for publication',
            'contact faculty student'
        ]);
        Role::create(['name' => 'guest'])->givePermissionTo([
            'view faculties',
            'view faculty details',
            'view selected articles'
        ]);

        Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());

    }
}
