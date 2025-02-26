<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            'name' => 'required|string|min:2',
            'emailr' => 'required|string|email|max:100|unique:users,email', // Ensure you're using 'email' to check uniqueness
            'passwordr' => 'required|string|confirmed|min:6',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Optional image validation
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->emailr; // Store emailr into the email column
        $user->password = Hash::make($request->passwordr); // Hash the password

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile_images', $filename); // Store the file in the public directory
            $user->profile_photo_path = 'profile_images/' . $filename; // Save the path in the database
        }

        $user->save(); // Save the user to the database

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
            'password' => 'required'
        ]);

        $userCredential = $request->only('email', 'password');
        if (Auth::attempt($userCredential)) {

            $route = $this->redirectDash();
            return redirect($route);
        } else {
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

        if (Auth::user() && Auth::user()->role == "1") {
            $redirect = '/admin/dashboard';
        } else if (Auth::user() && Auth::user()->role == "2") {
            $redirect = '/teacher/dashboard';
        } else {
            $redirect = '/home';
        }

        return $redirect;
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
