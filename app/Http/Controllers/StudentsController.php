<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class StudentsController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $enrollments = Student::with('course')
            ->where('name', $user->name)
            ->latest()
            ->get();
        $totalPaid = $enrollments->sum('paid_fee');
        return view('students.profile', compact('user', 'enrollments', 'totalPaid'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $courses = Course::all();
        $teachers = User::with('role')
            ->where('role_id', 2)
            ->get();
        return view('students.index', compact('courses', 'teachers', 'user'));
    }

    public function enrollStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'sex' => 'required|in:male,female,other',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'paid_fee' => 'required|integer|min:0',
        ]);

        Student::create([
            'name' => $request->input('name'),
            'sex' => $request->input('sex'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'course_id' => $request->input('course_id'),
            'paid_fee' => $request->input('paid_fee'),
        ]);

        return redirect()->back()->with('success', 'Student enrolled successfully.');
    }

    // Update Profile Section
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Name updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:6',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if ($request->hasFile('image')) {
            // Delete existing image if it exists and is within storage
            if ($user->profile_photo_path) {
                $existingImagePath = storage_path('app/public/' . $user->profile_photo_path);
                if (file_exists($existingImagePath)) {
                    @unlink($existingImagePath);
                }
            }

            // Store new image in profile-images
            $path = $request->file('image')->store('profile-images', 'public');
            $user->update(['profile_photo_path' => $path]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
