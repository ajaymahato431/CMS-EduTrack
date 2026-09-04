<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        if (Auth::user()) {
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:100',
            'emailr' => 'required|string|email|max:100|unique:users,email',
            'passwordr' => 'required|string|confirmed|min:6',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->emailr;
        $user->password = Hash::make($request->passwordr);
        $user->role_id = 3; // Default role ID for new users

        // Handle image upload safely
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile_images', 'public');
            $user->profile_photo_path = $path;
        }

        $user->save();

        return back()->with('success', 'Your registration has been successful.');
    }

    public function loadLogin()
    {
        if (Auth::user()) {
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = Str::transliterate(Str::lower($request->input('email')) . '|' . $request->ip());

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->with('error', "Too many login attempts. Please try again in {$seconds} seconds.");
        }

        $userCredential = $request->only('email', 'password');
        if (Auth::attempt($userCredential)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            $route = $this->redirectDash();
            return redirect($route);
        } else {
            RateLimiter::hit($throttleKey, 60);
            return back()->with('error', 'Username & Password is incorrect');
        }
    }

    public function loadDashboard()
    {
        return view('user.dashboard');
    }

    public function redirectDash()
    {
        $redirect = '';

        if (Auth::user() && Auth::user()->role_id == "1") {
            $redirect = '/admin/dashboard';
        } else if (Auth::user() && Auth::user()->role_id == "2") {
            $redirect = '/teacher/dashboard';
        } else {
            $redirect = '/home';
        }

        return $redirect;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
