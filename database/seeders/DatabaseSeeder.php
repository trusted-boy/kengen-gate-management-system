<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default departments
        $departments = [
            ['name' => 'Human Resources', 'code' => 'HR', 'description' => 'Human Resources Department'],
            ['name' => 'Finance', 'code' => 'FIN', 'description' => 'Finance and Accounts Department'],
            ['name' => 'Information Technology', 'code' => 'IT', 'description' => 'IT and Systems Department'],
            ['name' => 'Operations', 'code' => 'OPS', 'description' => 'Operations Department'],
            ['name' => 'Security', 'code' => 'SEC', 'description' => 'Security Department'],
            ['name' => 'Engineering', 'code' => 'ENG', 'description' => 'Engineering Department'],
            ['name' => 'Administration', 'code' => 'ADM', 'description' => 'Administration Department'],
            ['name' => 'Legal', 'code' => 'LEG', 'description' => 'Legal Affairs Department'],
            ['name' => 'Procurement', 'code' => 'PRO', 'description' => 'Procurement Department'],
            ['name' => 'Communications', 'code' => 'COM', 'description' => 'Corporate Communications'],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate(['code' => $dept['code']], $dept);
        }

        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@kengen.co.ke'],
            [
                'name' => 'System Administrator',
                'email' => 'admin@kengen.co.ke',
                'password' => Hash::make('password'),
                'role' => 'Admin',
            ]
        );

        // Create supervisor user
        User::firstOrCreate(
            ['email' => 'supervisor@kengen.co.ke'],
            [
                'name' => 'Security Supervisor',
                'email' => 'supervisor@kengen.co.ke',
                'password' => Hash::make('password'),
                'role' => 'Supervisor',
            ]
        );

        // Create security officer user
        User::firstOrCreate(
            ['email' => 'officer@kengen.co.ke'],
            [
                'name' => 'Security Officer',
                'email' => 'officer@kengen.co.ke',
                'password' => Hash::make('password'),
                'role' => 'Security Officer',
            ]
        );
    }
}
