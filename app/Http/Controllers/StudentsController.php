<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\course;
use App\Models\students;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    public function profile()
    {
        $user = DB::table('users')
        ->join('roles', 'users.role', '=', 'roles.role_id');
        return view('students.profile', compact('user'));

    }

    public function dashboard()
    {
        $courses = course::all();
        $teachers = User::where('role', '=', 2)->get();
        return view('students.index', compact(['courses', 'teachers']));
    }

    public function enrollStudent(Request $request)
        {
                
            $student = new students();
            $student->name = $request->name;
            $student->sex = $request->sex;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->course_id = $request->course_id;
            $student->paid_fee = $request->paid_fee;
            $student->save();
    
            return back()->with('success', 'Student Enrolled successfully.');
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
