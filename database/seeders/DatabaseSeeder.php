<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Roles
        $roles = [
            ['role_name' => 'admin'],
            ['role_name' => 'teacher'],
            ['role_name' => 'student'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Seed Admin User

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role_id' => 1,
            'email_verified_at' => now(),
        ]);

        // Seed Courses
        $courses = [
            [
                'course_name' => 'Introduction to Programming',
                'credit_hours' => 3,
                'fee' => 1500,
            ],
            [
                'course_name' => 'Database Management',
                'credit_hours' => 4,
                'fee' => 2000,
            ],
            [
                'course_name' => 'Web Development',
                'credit_hours' => 3,
                'fee' => 1800,
            ],
            [
                'course_name' => 'Data Structures',
                'credit_hours' => 4,
                'fee' => 2200,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
