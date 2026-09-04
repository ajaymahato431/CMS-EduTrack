<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

beforeEach(function () {
    Role::create(['id' => 1, 'role_name' => 'admin']);
    Role::create(['id' => 2, 'role_name' => 'teacher']);
    Role::create(['id' => 3, 'role_name' => 'student']);
});

test('storage route blocks path traversal attempts to read sensitive files', function () {
    $traversalPayloads = [
        '../../.env',
        '..%2F..%2F.env',
        '....//....//.env',
        'dir/../../.env',
    ];

    foreach ($traversalPayloads as $payload) {
        $response = $this->get('/storage/' . $payload);
        $response->assertStatus(404);
    }
});

test('unauthenticated users are redirected from admin routes', function () {
    $response = $this->get('/admin/dashboard');

    $response->assertRedirect('/');
});

test('students cannot access admin dashboard', function () {
    $student = User::create([
        'name' => 'Student User',
        'email' => 'student@example.com',
        'password' => Hash::make('secret123'),
        'role_id' => 3,
    ]);

    $response = $this->actingAs($student)->get('/admin/dashboard');

    $response->assertRedirect('/');
});

test('students cannot access teacher dashboard', function () {
    $student = User::create([
        'name' => 'Student User',
        'email' => 'student@example.com',
        'password' => Hash::make('secret123'),
        'role_id' => 3,
    ]);

    $response = $this->actingAs($student)->get('/teacher/dashboard');

    $response->assertRedirect('/');
});
