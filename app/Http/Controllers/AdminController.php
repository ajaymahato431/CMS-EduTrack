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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'addUser')
                ->withInput()
                ->with('show_modal', 'addUserModal');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->back()->with('success', 'User added successfully.');
    }

    public function editUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|min:2',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($request->user_id)],
            'password' => 'nullable|string|confirmed|min:6',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'editUser')
                ->withInput()
                ->with('show_modal', 'editUserModal');
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        if ($request->filled('role_id')) {
            $updateData['role_id'] = $request->role_id;
        }

        User::findOrFail($request->user_id)->update($updateData);

        return redirect()->back()->with('success', 'User updated successfully.');
    }


    public function deleteUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'deleteUser');
        }

        if ((int) $request->user_id === auth()->id()) {
            return back()->with('error', 'You cannot delete the currently authenticated user.');
        }

        User::whereKey($request->user_id)->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }


    // Course Section
    public function addCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|unique:courses,course_name',
            'credit_hours' => 'required|integer|min:1',
            'fee' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'addCourse')
                ->withInput()
                ->with('show_modal', 'addCourseModal');
        }

        Course::create([
            'course_name' => $request->course_name,
            'credit_hours' => $request->credit_hours,
            'fee' => $request->fee,
        ]);

        return redirect()->back()->with('success', 'Course added successfully.');
    }


    public function editCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'course_name' => ['required', 'string', Rule::unique('courses', 'course_name')->ignore($request->course_id)],
            'credit_hours' => 'required|integer|min:1',
            'fee' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'editCourse')
                ->withInput()
                ->with('show_modal', 'editCourseModal');
        }

        Course::findOrFail($request->course_id)->update([
            'course_name' => $request->course_name,
            'credit_hours' => $request->credit_hours,
            'fee' => $request->fee,
        ]);

        return redirect()->back()->with('success', 'Course updated successfully.');
    }


    public function deleteCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'deleteCourse');
        }

        Course::whereKey($request->course_id)->delete();

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }


    // Student Section
    public function addStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
            'sex' => 'required|in:male,female,other',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'paid_fee' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'addStudent')
                ->withInput()
                ->with('show_modal', 'addStudentModal');
        }

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
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|min:2',
            'sex' => 'required|in:male,female,other',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            'paid_fee' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'editStudent')
                ->withInput()
                ->with('show_modal', 'editStudentModal');
        }

        Student::findOrFail($request->student_id)->update($request->only([
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
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator, 'deleteStudent');
        }

        Student::whereKey($request->student_id)->delete();

        return redirect()->back()->with('success', 'Student deleted successfully.');
    }


    // Update Profile Section
    public function updateName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|exists:users,id',
            'name' => 'required|string|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'updateName') // 👈 Use a named error bag
                ->withInput();
        }

        User::findOrFail($request->userId)->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Name updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|exists:users,id',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'updatePassword') // 👈 Use a named error bag
                ->withInput();
        }

        User::findOrFail($request->userId)->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|exists:users,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // 👈 Changed to 'required' for clarity
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'updateProfile') // 👈 Use a named error bag
                ->withInput();
        }

        $user = User::findOrFail($request->userId);

        if ($request->hasFile('image')) {
            // Delete existing image if it's not the default one
            if ($user->profile_photo_path && $user->profile_photo_path !== 'profile-images/default.jpg') {
                Storage::delete('public/' . $user->profile_photo_path);
            }

            // Store new image in 'storage/app/public/profile-images'
            $path = $request->file('image')->store('profile-images', 'public');

            $user->update(['profile_photo_path' => $path]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function bulkDeleteUsers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'integer|exists:users,id',
        ], [
            'selected_ids.required' => 'Select at least one user to delete.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'bulkUsers')
                ->withInput()
                ->with('show_modal', 'bulkDeleteUsersModal');
        }

        $ids = collect($request->selected_ids)
            ->map(fn($id) => (int) $id)
            ->filter(fn($id) => $id !== auth()->id())
            ->values()
            ->all();

        if (empty($ids)) {
            return back()->with('error', 'No valid users selected for deletion.');
        }

        User::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', 'Selected users deleted successfully.');
    }

    public function bulkDeleteCourses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'integer|exists:courses,id',
        ], [
            'selected_ids.required' => 'Select at least one course to delete.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'bulkCourses')
                ->withInput()
                ->with('show_modal', 'bulkDeleteCoursesModal');
        }

        Course::whereIn('id', $request->selected_ids)->delete();

        return redirect()->back()->with('success', 'Selected courses deleted successfully.');
    }

    public function bulkDeleteStudents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'integer|exists:students,id',
        ], [
            'selected_ids.required' => 'Select at least one student to delete.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator, 'bulkStudents')
                ->withInput()
                ->with('show_modal', 'bulkDeleteStudentsModal');
        }

        Student::whereIn('id', $request->selected_ids)->delete();

        return redirect()->back()->with('success', 'Selected students deleted successfully.');
    }
}
