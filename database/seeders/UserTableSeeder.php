<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'System',
                'last_name' => 'Admin',
                'username' => 'systemadmin',
                'email' => 'admin@example.com',
                'password' => bcrypt('1234'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'admin',
                'status' => 'active',
            ],
            [
                'first_name' => 'Demo',
                'last_name' => 'Admin',
                'username' => 'demoadmin',
                'email' => 'demo@example.com',
                'password' => bcrypt('1234'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'demo_admin',
            ],
            [
                'first_name' => 'John',
                'last_name' => 'User',
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => bcrypt('1234'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'user',
                'status' => 'inactive'
            ]
        ];

        foreach ($users as $value) {
            $roleName = $value['user_type'];

            // Create or update user by email
            $user = User::updateOrCreate(
                ['email' => $value['email']], // unique identifier
                $value
            );

            // Assign role safely (no duplicates)
            if (!$user->hasRole($roleName)) {
                $user->assignRole($roleName);
            }
        }
    }
}
