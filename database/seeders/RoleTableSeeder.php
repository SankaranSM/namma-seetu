<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'title' => 'Admin',
                'status' => 1,
                'permissions' => ['role', 'role-add', 'role-list', 'permission', 'permission-add', 'permission-list']
            ],
            [
                'name' => 'demo_admin',
                'title' => 'Demo Admin',
                'status' => 1,
                'permissions' => []
            ],
            [
                'name' => 'user',
                'title' => 'User',
                'status' => 1,
                'permissions' => []
            ]
        ];

        foreach ($roles as $value) {
            $permissions = $value['permissions'];
            unset($value['permissions']);

            $role = Role::updateOrCreate(
                ['name' => $value['name']],
                $value
            );

            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }
        }
    }
}
