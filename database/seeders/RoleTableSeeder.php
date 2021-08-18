<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Administrator',
            'PS Worker',
            'PS Supervisor'
        ];
        
        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $administratorRole = Role::findById(1);
        $administratorRole->syncPermissions([
            'users-roles-menu', 'user-list', 'user-delete', 'user-edit', 'user-create',
            'role-list', 'role-delete', 'role-edit', 'role-create',
            'settings-menu',
        ]);


        $pswRole = Role::findById(2);
        $pswRole->syncPermissions([
            'individual-create',
            'pss-case-list',
            'pss-case-create',
            'ps-worker-menu',
        ]);

        $psSupervisorRole = Role::findById(3);
        $psSupervisorRole->syncPermissions([
            'individual-create',
            'pss-case-list',
            'pss-supervisor-menu',
        ]);


    }
}
