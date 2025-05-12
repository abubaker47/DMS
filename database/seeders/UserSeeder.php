<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'department_id' => 1, // Administration
            'role' => 'admin',
            'position' => 'System Administrator',
            'phone' => '+93 70 123 4567',
            'is_active' => true,
            'preferred_language' => 'en',
            'email_verified_at' => now(),
        ]);

        // Create department users
        $departmentUsers = [
            [
                'name' => 'Finance Manager',
                'email' => 'finance@example.com',
                'password' => Hash::make('password'),
                'department_id' => 2, // Finance
                'role' => 'user',
                'position' => 'Finance Manager',
                'phone' => '+93 70 123 4568',
                'is_active' => true,
                'preferred_language' => 'en',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'HR Manager',
                'email' => 'hr@example.com',
                'password' => Hash::make('password'),
                'department_id' => 3, // Human Resources
                'role' => 'user',
                'position' => 'HR Manager',
                'phone' => '+93 70 123 4569',
                'is_active' => true,
                'preferred_language' => 'dari',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'IT Manager',
                'email' => 'it@example.com',
                'password' => Hash::make('password'),
                'department_id' => 4, // IT
                'role' => 'user',
                'position' => 'IT Manager',
                'phone' => '+93 70 123 4570',
                'is_active' => true,
                'preferred_language' => 'pashto',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Legal Manager',
                'email' => 'legal@example.com',
                'password' => Hash::make('password'),
                'department_id' => 5, // Legal
                'role' => 'user',
                'position' => 'Legal Manager',
                'phone' => '+93 70 123 4571',
                'is_active' => true,
                'preferred_language' => 'en',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($departmentUsers as $user) {
            User::create($user);
        }
    }
}
