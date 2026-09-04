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

test('student home page renders hero section and course catalog with Rs fees', function () {
    $studentUser = User::create([
        'name' => 'Samantha Learner',
        'email' => 'samantha@example.com',
        'password' => Hash::make('secret123'),
        'role_id' => 3,
    ]);

    Course::create([
        'course_name' => 'Artificial Intelligence & Machine Learning',
        'credit_hours' => 4,
        'fee' => 7500,
    ]);

    $response = $this->actingAs($studentUser)->get('/home');

    $response->assertStatus(200);
    $response->assertSee('Your Bright Future is Our Mission');
    $response->assertSee('Our Featured Courses');
    $response->assertSee('Artificial Intelligence & Machine Learning');
    $response->assertSee('Rs. 7,500');
    $response->assertSee('Profile');
    $response->assertSee('Log Out');
});

test('student profile page renders matching hero section, user details, and enrollments', function () {
    $studentUser = User::create([
        'name' => 'Samantha Learner',
        'email' => 'samantha@example.com',
        'password' => Hash::make('secret123'),
        'role_id' => 3,
    ]);

    $course = Course::create([
        'course_name' => 'Cybersecurity Fundamentals',
        'credit_hours' => 3,
        'fee' => 4800,
    ]);

    Student::create([
        'name' => 'Samantha Learner',
        'sex' => 'female',
        'phone' => '9841999999',
        'address' => 'Kathmandu',
        'course_id' => $course->id,
        'paid_fee' => 4800,
    ]);

    $response = $this->actingAs($studentUser)->get('/profile');

    $response->assertStatus(200);
    $response->assertSee('Student Portal & Profile', false);
    $response->assertSee('Samantha Learner');
    $response->assertSee('samantha@example.com');
    $response->assertSee('Student');
    $response->assertSee('Cybersecurity Fundamentals');
    $response->assertSee('Rs. 4,800');
    $response->assertSee('Update Profile Photo');
    $response->assertSee('Edit Full Name');
    $response->assertSee('Change Password');
    $response->assertSee('About EduTrack');
});

test('student can enroll in a course successfully', function () {
    $studentUser = User::create([
        'name' => 'Rohan Sharma',
        'email' => 'rohan@example.com',
        'password' => Hash::make('secret123'),
        'role_id' => 3,
    ]);

    $course = Course::create([
        'course_name' => 'Mobile App Development',
        'credit_hours' => 3,
        'fee' => 5500,
    ]);

    $response = $this->actingAs($studentUser)->post('/enrollStudent', [
        'name' => 'Rohan Sharma',
        'sex' => 'male',
        'phone' => '9801234567',
        'address' => 'Chitwan',
        'course_id' => $course->id,
        'paid_fee' => 5500,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    expect(Student::where('name', 'Rohan Sharma')->exists())->toBeTrue();
    $student = Student::where('name', 'Rohan Sharma')->first();
    expect($student->course_id)->toBe($course->id);
    expect($student->paid_fee)->toBe(5500);
});
