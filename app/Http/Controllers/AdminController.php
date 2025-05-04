<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // View Section
    public function dashboard()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }

    public function users()
    {
        $users = User::with('role')
            ->where('id', '!=', auth()->id())
            ->paginate(8);
        $roles = Role::all();
        return view('admin.user', compact('users', 'roles'));
    }

    public function manageRole()
    {
        $users = User::with('role')
            ->where('role_id', '!=', 1)
            ->get();
        $roles = Role::all();
        return view('admin.manage-role', compact('users', 'roles'));
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::findOrFail($request->user_id)->update([
            'role_id' => $request->role_id,
        ]);

        return redirect()->back()->with('success', 'Role updated successfully.');
    }

    public function course()
    {
        $courses = Course::paginate(8);
        return view('admin.course', compact('courses'));
    }

    public function students()
    {
        $students = Student::with('course')->paginate(8);
        $courses = Course::all();
        return view('admin.students', compact('students', 'courses'));
    }

    // User Section
    public function editUser(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email,' . $request->userId,
            'password' => 'nullable|string|min:6',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        User::findOrFail($request->userId)->update($updateData);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function deleteUser(Request $request)
    {
        $request->validate([
            'user' => 'required|exists:users,id',
        ]);

        User::findOrFail($request->user)->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
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
            $path = $file->storeAs('public', $filename);

            $user->update(['profile_photo_path' => $filename]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
