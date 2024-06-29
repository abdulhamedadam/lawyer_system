<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
class PermissionTableSeeder extends Seeder
{

    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        $permissions = [
            translate('cases'),translate('add_case'),translate('edit_case'),translate('delete_case'),translate('case_files'),translate('case_money'),translate('case_tasks'),
            translate('clients'),translate('add_client'),translate('edit_client'),translate('delete_client'),translate('client_files'),translate('client_cases'),translate('client_money'),
            translate('add_tasks'),translate('all_tasks'),translate('outcomming_tasks'),translate('incomming_tasks'),translate('done_tasks'),translate('doing_tasks'),translate('canceled_tasks'),
            translate('needReply_tasks'),translate('evaluated_tasks'),translate('delete_tasks'),translate('edit_tasks'),translate('comment_tasks'),translate('extend_data_tasks'),translate('delayed_tasks'),
            translate('evalute_tasks'),translate('end_tasks'),translate('add_employees'),translate('employees'),translate('edit_employee'),translate('delete_employee'),translate('employee_files'),
            translate('general_settings'),translate('edit_general_setting'),translate('delete_general_setting'),
            translate('users_roles'),translate('users_password'),
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission,'guard_name'=>'admin']);
        }

    }
}
