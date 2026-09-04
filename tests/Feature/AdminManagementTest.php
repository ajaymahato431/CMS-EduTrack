<?php

use App\Models\Course;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['id' => 1, 'role_name' => 'admin']);
    Role::create(['id' => 2, 'role_name' => 'teacher']);
    Role::create(['id' => 3, 'role_name' => 'student']);
});

test('admin dashboard renders metrics and recent activity', function () {
    $admin = User::create([
        'name' => 'Super Admin',
        'email' => 'superadmin@example.com',
        'password' => Hash::make('password'),
        'role_id' => 1,
    ]);

    $course = Course::create([
        'course_name' => 'Computer Science 101',
        'credit_hours' => 3,
        'fee' => 5000,
    ]);

    Student::create([
        'name' => 'Alice Student',
        'sex' => 'female',
        'phone' => '9800000001',
        'address' => 'Kathmandu',
        'course_id' => $course->id,
        'paid_fee' => 5000,
    ]);

    $response = $this->actingAs($admin)->get('/admin');

    $response->assertStatus(200);
    $response->assertSee('Admin Dashboard');
    $response->assertSee('Total Students');
    $response->assertSee('Total Teachers');
    $response->assertSee('Total Courses');
    $response->assertSee('Fee Collection');
    $response->assertSee('Rs. 5,000');
    $response->assertSee('Alice Student');
    $response->assertSee('Computer Science 101');
});

test('admin users view supports search and role filter', function () {
    $admin = User::create([
        'name' => 'Main Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role_id' => 1,
    ]);

    $teacher = User::create([
        'name' => 'Prof Charles',
        'email' => 'charles@example.com',
        'password' => Hash::make('password'),
        'role_id' => 2,
    ]);

    $studentUser = User::create([
        'name' => 'Bob Junior',
        'email' => 'bob@example.com',
        'password' => Hash::make('password'),
        'role_id' => 3,
    ]);

    // Search query matches Charles
    $response = $this->actingAs($admin)->get('/admin/users?search=Charles');
    $response->assertStatus(200);
    $response->assertSee('Prof Charles');
    $response->assertDontSee('Bob Junior');

    // Filter by student role (role_id=3)
    $responseRole = $this->actingAs($admin)->get('/admin/users?role_id=3');
    $responseRole->assertStatus(200);
    $responseRole->assertSee('Bob Junior');
    $responseRole->assertDontSee('Prof Charles');
});

test('admin courses view supports search and displays Rs fee format', function () {
    $admin = User::create([
        'name' => 'Admin Boss',
        'email' => 'boss@example.com',
        'password' => Hash::make('password'),
        'role_id' => 1,
    ]);

    Course::create([
        'course_name' => 'Discrete Mathematics',
        'credit_hours' => 4,
        'fee' => 3500,
    ]);

    Course::create([
        'course_name' => 'Software Engineering',
        'credit_hours' => 3,
        'fee' => 4200,
    ]);

    $response = $this->actingAs($admin)->get('/admin/course?search=Discrete');
    $response->assertStatus(200);
    $response->assertSee('Discrete Mathematics');
    $response->assertSee('Rs. 3,500');
    $response->assertDontSee('Software Engineering');
});

test('admin can update user role via manage role', function () {
    $admin = User::create([
        'name' => 'Admin Boss',
        'email' => 'boss2@example.com',
        'password' => Hash::make('password'),
        'role_id' => 1,
    ]);

    $user = User::create([
        'name' => 'David Candidate',
        'email' => 'david@example.com',
        'password' => Hash::make('password'),
        'role_id' => 3,
    ]);

    $response = $this->actingAs($admin)->post('/admin/manage-role', [
        'user_id' => $user->id,
        'role_id' => 2,
    ]);

    $response->assertRedirect();
    expect($user->fresh()->role_id)->toBe(2);
    expect($user->fresh()->isTeacher())->toBeTrue();
});

test('teacher dashboard renders teacher metrics and assigned courses', function () {
    $teacher = User::create([
        'name' => 'Instructor Sarah',
        'email' => 'sarah@example.com',
        'password' => Hash::make('password'),
        'role_id' => 2,
    ]);

    $course = Course::create([
        'course_name' => 'Organic Chemistry',
        'credit_hours' => 4,
        'fee' => 6000,
    ]);

    Student::create([
        'name' => 'Tom Student',
        'sex' => 'male',
        'phone' => '9800000002',
        'address' => 'Pokhara',
        'course_id' => $course->id,
        'paid_fee' => 6000,
    ]);

    $response = $this->actingAs($teacher)->get('/teacher');

    $response->assertStatus(200);
    $response->assertSee('Teacher Dashboard');
    $response->assertSee('Academic Courses');
    $response->assertSee('Enrolled Students');
    $response->assertSee('Organic Chemistry');
    $response->assertSee('Tom Student');
    $response->assertSee('Rs. 6,000');
});

test('user model role helpers and avatar fallback work properly', function () {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'testuser@example.com',
        'password' => Hash::make('password'),
        'role_id' => 1,
    ]);

    expect($user->isAdmin())->toBeTrue();
    expect($user->isTeacher())->toBeFalse();
    expect($user->isStudent())->toBeFalse();
    expect($user->avatar_url)->toContain('ui-avatars.com');
});

test('admin students view supports search and course filter', function () {
    $admin = User::create([
        'name' => 'Admin Boss',
        'email' => 'boss3@example.com',
        'password' => Hash::make('password'),
        'role_id' => 1,
    ]);

    $courseMath = Course::create([
        'course_name' => 'Calculus I',
        'credit_hours' => 3,
        'fee' => 4000,
    ]);

    $courseBio = Course::create([
        'course_name' => 'Biology I',
        'credit_hours' => 3,
        'fee' => 4500,
    ]);

    Student::create([
        'name' => 'John Carter',
        'sex' => 'male',
        'phone' => '9841000001',
        'address' => 'Lalitpur',
        'course_id' => $courseMath->id,
        'paid_fee' => 4000,
    ]);

    Student::create([
        'name' => 'Emma Watson',
        'sex' => 'female',
        'phone' => '9841000002',
        'address' => 'Bhaktapur',
        'course_id' => $courseBio->id,
        'paid_fee' => 4500,
    ]);

    // Search by student name
    $responseSearch = $this->actingAs($admin)->get('/admin/students?search=Carter');
    $responseSearch->assertStatus(200);
    $responseSearch->assertSee('John Carter');
    $responseSearch->assertDontSee('Emma Watson');

    // Filter by course
    $responseCourse = $this->actingAs($admin)->get('/admin/students?course_id=' . $courseBio->id);
    $responseCourse->assertStatus(200);
    $responseCourse->assertSee('Emma Watson');
    $responseCourse->assertDontSee('John Carter');
});

test('admin manage role page renders audit overview and role counts', function () {
    $admin = User::create([
        'name' => 'Admin Boss',
        'email' => 'boss4@example.com',
        'password' => Hash::make('password'),
        'role_id' => 1,
    ]);

    User::create([
        'name' => 'Teacher One',
        'email' => 't1@example.com',
        'password' => Hash::make('password'),
        'role_id' => 2,
    ]);

    User::create([
        'name' => 'Student One',
        'email' => 's1@example.com',
        'password' => Hash::make('password'),
        'role_id' => 3,
    ]);

    $response = $this->actingAs($admin)->get('/admin/manage-role');

    $response->assertStatus(200);
    $response->assertSee('Role Management & Permissions');
    $response->assertSee('User Role Audit Directory');
    $response->assertSee('Teacher One');
    $response->assertSee('Student One');
});

