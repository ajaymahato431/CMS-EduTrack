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

test('login screen can be rendered', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('users can register', function () {
    $response = $this->post('/register', [
        'name' => 'John Doe',
        'emailr' => 'john@example.com',
        'passwordr' => 'secret123',
        'passwordr_confirmation' => 'secret123',
    ]);

    $response->assertSessionHas('success');
    $this->assertDatabaseHas('users', [
        'email' => 'john@example.com',
        'name' => 'John Doe',
        'role_id' => 3,
    ]);
});

test('users can authenticate using valid credentials', function () {
    $user = User::create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'password' => Hash::make('secret123'),
        'role_id' => 3,
    ]);

    $response = $this->post('/login', [
        'email' => 'jane@example.com',
        'password' => 'secret123',
    ]);

    $this->assertAuthenticatedAs($user);
    $response->assertRedirect('/home');
});

test('users cannot authenticate with invalid password', function () {
    User::create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'password' => Hash::make('secret123'),
        'role_id' => 3,
    ]);

    $response = $this->post('/login', [
        'email' => 'jane@example.com',
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
    $response->assertSessionHas('error');
});

test('authenticated users can logout', function () {
    $user = User::create([
        'name' => 'Jane Doe',
        'email' => 'jane@example.com',
        'password' => Hash::make('secret123'),
        'role_id' => 3,
    ]);

    $response = $this->actingAs($user)->get('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
