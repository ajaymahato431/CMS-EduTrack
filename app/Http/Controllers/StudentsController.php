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
        return view('students.profile', compact('user'));
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
       // $request->validate([
            //     'name' => 'required|string|min:2',
            //     'sex' => 'required|in:male,female,other',
            //     'phone' => 'required|string|max:15',
            //     'address' => 'required|string',
            //     'course_id' => 'required|exists:courses,id',
            //     'paid_fee' => 'required|integer|min:0',
            // ]);

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
            'userId' => 'required|exists:users,id',
            'name' => 'required|string|min:2',
        ]);

        User::findOrFail($request->userId)->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Name updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::findOrFail($request->userId)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::findOrFail($request->userId);

        if ($request->hasFile('image')) {
            // Delete existing image if it exists
            if ($user->profile_photo_path) {
                $existingImagePath = storage_path('app/public/' . $user->profile_photo_path);
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }
            }

            // Store new image
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $filename);

            $user->update(['profile_photo_path' => $filename]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
