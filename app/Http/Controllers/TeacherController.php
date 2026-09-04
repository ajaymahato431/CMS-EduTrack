<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    // View Section
    public function dashboard()
    {
        $user = Auth::user();
        $totalCourses = Course::count();
        $totalStudents = Student::count();
        $recentStudents = Student::with('course')->latest()->take(5)->get();
        $courses = Course::withCount('students')->latest()->take(5)->get();

        return view('teacher.dashboard', compact('user', 'totalCourses', 'totalStudents', 'recentStudents', 'courses'));
    }

    public function course(Request $request)
    {
        $query = Course::withCount('students');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('course_name', 'like', "%{$search}%");
        }

        $courses = $query->latest()->paginate(8)->withQueryString();
        return view('teacher.course', compact('courses'));
    }

    public function students(Request $request)
    {
        $query = Student::with('course');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        $students = $query->latest()->paginate(10)->withQueryString();
        $courses = Course::all();
        return view('teacher.students', compact('students', 'courses'));
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
                ->withErrors($validator, 'tAddCourse')
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
                ->withErrors($validator, 'tEditCourse')
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
            return back()->withErrors($validator, 'tDeleteCourse');
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
                ->withErrors($validator, 'tAddStudent')
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
                ->withErrors($validator, 'tEditStudent')
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
            return back()->withErrors($validator, 'tDeleteStudent');
        }
        Student::whereKey($request->student_id)->delete();
        return redirect()->back()->with('success', 'Student deleted successfully.');
    }
    // Update Profile Section
    public function updateName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'updateName')
                ->withInput();
        }

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Name updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'updatePassword')
                ->withInput();
        }

        /** @var User $user */
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'updateProfile')
                ->withInput();
        }

        /** @var User $user */
        $user = Auth::user();

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
                ->withErrors($validator, 'tBulkCourses')
                ->withInput()
                ->with('show_modal', 'teacherBulkDeleteCoursesModal');
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
                ->withErrors($validator, 'tBulkStudents')
                ->withInput()
                ->with('show_modal', 'teacherBulkDeleteStudentsModal');
        }
        Student::whereIn('id', $request->selected_ids)->delete();
        return redirect()->back()->with('success', 'Selected students deleted successfully.');
    }
}
