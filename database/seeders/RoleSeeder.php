<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission ;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Roles and Permissions

        $admin_permission = Permission::create(['name' => 'admin']);
        $user_permission = Permission::create(['name' => 'user']);
        $resident_permission = Permission::create(['name' => 'resident']);

        $admin_role = Role::create(['name' => 'admin']);
        $user_role = Role::create(['name' => 'user']);
        $resident_role = Role::create(['name' => 'resident']);


        $admin_role->givePermissionTo($admin_permission);
        $user_role->givePermissionTo($user_permission);
        $resident_role->givePermissionTo($resident_permission);



        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin111')
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user')
        ]);

        $user->assignRole('user');
        $admin->assignRole('admin');

    }
}
