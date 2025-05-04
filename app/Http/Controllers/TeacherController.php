<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // View Section
    public function dashboard()
    {
        $user = Auth::user();
        return view('teacher.dashboard', compact('user'));
    }

    public function course()
    {
        $courses = Course::paginate(8);
        return view('teacher.course', compact('courses'));
    }

    public function students()
    {
        $students = Student::with('course')->paginate(8);
        $courses = Course::all();
        return view('teacher.students', compact('students', 'courses'));
    }

    // Course Section
    public function addCourse(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|unique:courses,course_name',
            'credit_hours' => 'required|integer|min:1',
            'fee' => 'required|integer|min:0',
        ]);

        Course::create([
            'course_name' => $request->course_name,
            'credit_hours' => $request->credit_hours,
            'fee' => $request->fee,
        ]);

        return redirect()->back()->with('success', 'Course added successfully.');
    }

    public function editCourse(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:courses,id',
            'course_name' => 'required|string|unique:courses,course_name,' . $request->userId,
            'credit_hours' => 'required|integer|min:1',
            'fee' => 'required|integer|min:0',
        ]);

        Course::findOrFail($request->userId)->update([
            'course_name' => $request->course_name,
            'credit_hours' => $request->credit_hours,
            'fee' => $request->fee,
        ]);

        return redirect()->back()->with('success', 'Course updated successfully.');
    }

    public function deleteCourse(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:courses,id',
        ]);

        Course::findOrFail($request->user)->delete();

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }

    // Student Section
    public function addStudent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'sex' => 'required|in:male,female,other',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'paid_fee' => 'required|integer|min:0',
        ]);

        Student::create($request->only([
            'name',
            'sex',
            'phone',
            'address',
            'course_id',
            'paid_fee',
        ]));

        return redirect()->back()->with('success', 'Student added successfully.');
    }

    public function editStudent(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:students,id',
            'name' => 'required|string|min:2',
            'sex' => 'required|in:male,female,other',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'paid_fee' => 'required|integer|min:0',
        ]);

        Student::findOrFail($request->userId)->update($request->only([
            'name',
            'sex',
            'phone',
            'address',
            'course_id',
            'paid_fee',
        ]));

        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    public function deleteStudent(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:students,id',
        ]);

        Student::findOrFail($request->user)->delete();

        return redirect()->back()->with('success', 'Student deleted successfully.');
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
