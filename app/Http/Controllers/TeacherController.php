<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\course;
use App\Models\students;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class TeacherController extends Controller
{
   
    //View Section
    public function dashboard()
    {
        $user = DB::table('users')
        ->join('roles', 'users.role', '=', 'roles.role_id');
        return view('teacher.dashboard', compact('user'));

    }

    // public function users()
    // {
    //     $users = DB::table('users')
    //     ->join('roles', 'users.role', '=', 'roles.role_id')
    //     ->where('id', '!=', auth()->user()->id)
    //     ->paginate(8); 
    //     $roles = Role::all();
    //     return view('admin.user', compact(['users', 'roles']));
    // }

    // public function manageRole()
    // {
    //     $users = User::where('role', '!=', 1)->get();
    //     $roles = Role::all();
    //     return view('admin.manage-role', compact(['users', 'roles']));
    // }

    // public function updateRole(Request $request)
    // {
    //     User::where('id', $request->user_id)->update([
    //         'role' => $request->role_id,
    //     ]);
    //     return redirect()->back();
    // }

    public function course()
    {
        $course = course::paginate(8);
        return view('teacher.course', compact('course'));
    }

    public function students()
{
    $students = DB::table('students')
    ->join('courses', 'students.course_id', '=', 'courses.course_id')
    ->paginate(8);     
    $courses = Course::all();
    return view('teacher.students', compact('students', 'courses'));
}



    // User Section



    // public function editUser(Request $request)
    // {
    //     // Retrieve user details from the request
    //     $userId = $request->userId;
    //     $name = $request->name;
    //     $email = $request->email;
    //     $password = Hash::make($request->password);
    //     // $role_id = $request->role_id; // Uncomment this if you're also updating the role

    //     // Update the user record in the database
    //     User::where('id', $userId)->update([
    //         'name' => $name,
    //         'email' => $email,
    //         'password' => $password,
    //         // 'role_id' => $role_id, // Uncomment this if you're also updating the role
    //     ]);

    //     // Redirect back to the previous page
    //     return redirect()->back();
    // }

    // public function deleteUser(Request $request)
    // {

    //     $id = $request->user;

    //     $record = User::find($id);

    //     if ($record) {
    //         $record->delete();
    //     }

    //     return redirect()->back();
    // }



    // Course Section

    public function addCourse(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|unique:courses',
            'credit_hours' => 'required|integer',
            'fee' => 'required|integer',
        ]);
    
        $course = new Course;
        $course->course_name = $request->course_name;
        $course->credit_hours = $request->credit_hours;
        $course->fee = $request->fee;
        $course->save();
    
        return redirect()->back()->with('success', 'Course added successfully.');
    }

    public function editCourse(Request $request)
    {
        // Retrieve user details from the request
        $courseId = $request->userId;
        $course_name = $request->course_name;
        $credit_hours = $request->credit_hours;
        $fee =$request->fee;

        // Update the user record in the database
        course::where('course_id', $courseId)->update([
            'course_name' => $course_name,
            'credit_hours' => $credit_hours,
            'fee' => $fee,
        ]);

        // Redirect back to the previous page
        return redirect()->back();
    }

    public function deleteCourse(Request $request)
    {

        $id = $request->user;

        // $record = course::find($course_id);

        // if ($record) {
        //     $record->delete();
        // }

        $course = DB::table('courses')->where('course_id',$id)->delete();

        return redirect()->back();
    }
    

        // Student Section

        public function addStudent(Request $request)
        {
                
            $student = new students();
            $student->name = $request->name;
            $student->sex = $request->sex;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->course_id = $request->course_id;
            $student->paid_fee = $request->paid_fee;
            $student->save();
    
            return back()->with('success', 'Student added successfully.');
        }
    
        public function editStudent(Request $request)
        {
              
            students::where('id', $request->userId)->update([
                'name' => $request->name,
                'sex' => $request->sex,
                'phone' => $request->phone,
                'address' => $request->address,
                'course_id' => $request->course_id,
                'paid_fee' => $request->paid_fee,
            ]);
    
            return back()->with('success', 'Student updated successfully.');
        }
    
        public function deleteStudent(Request $request)
        {
            $id = $request->user;

        $record = students::find($id);

        if ($record) {
            $record->delete();
        }

            return back()->with('success', 'Student deleted successfully.');
        }

        //Update Profile Section

        public function updateName(Request $request)
        {
            $request->validate([
                'name' => 'string|required|min:2',
               
            ]);
              
            User::where('id', $request->userId)->update([
                'name' => $request->name,                
            ]);
    
            return back()->with('success', 'Student updated successfully.');
        }

        public function updatePassword(Request $request)
        {
            $request->validate([
                
                'password' =>'string|required|confirmed|min:6'
            ]);
              
            User::where('id', $request->userId)->update([
                'password' => Hash::make($request->password),                
            ]);
    
            return back()->with('success', 'Student updated successfully.');
        }

        public function updateProfile(Request $request)
        {
            // Update the profile image if a file is provided
            if ($request->hasFile('image')) {
                $user = User::find($request->userId);
        
                // Delete any existing image file
                if ($user->profile_photo_path) {
                    $existingImagePath = storage_path('public/' . $user->profile_photo_path);
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }
        
                // Store the new image
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = $file->storeAs('public', $filename);
        
                // Update the user's profile photo path
                $user->profile_photo_path = $filename;
                $user->save();
            }
        
            return back()->with('success', 'Profile updated successfully.');
        }

}
