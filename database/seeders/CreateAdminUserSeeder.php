<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Admin::create([
            'name' => 'main_admin',
            'email' => 'main_admin@yahoo.com',
            'password' => bcrypt('102030'),
            'roles_name' =>['owner'],
            'status' =>'active',
        ]);
//        $role = Role::create(['name' => 'owner']);
//        $permissions = Permission::pluck('id','id')->all();
//        $role->syncPermissions($permissions);
//        $user->assignRole([$role->id]);
    }
}
