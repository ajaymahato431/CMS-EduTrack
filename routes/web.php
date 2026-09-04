<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('throttle:10,1');
// Route::get('/login', function () {
//     return redirect('/');
// });
Route::get('/', [AuthController::class, 'loadLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('throttle:5,1');
Route::get('/logout', [AuthController::class, 'logout']);

// ********** Admin Routes *********
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'isAdmin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/users', [AdminController::class, 'users'])->name('AdminUsers');
    Route::post('/addUser', [AdminController::class, 'addUser'])->name('addUser');
    Route::get('/manage-role', [AdminController::class, 'manageRole'])->name('manageRole');
    Route::post('/update-role', [AdminController::class, 'updateRole'])->name('updateRole');
    Route::get('/course', [AdminController::class, 'course'])->name('admin.course');
    Route::get('/students', [AdminController::class, 'students'])->name('admin.students');

    Route::post('/editUser', [AdminController::class, 'editUser'])->name('editUser');
    Route::post('/deleteUser', [AdminController::class, 'deleteUser'])->name('deleteUser');
    // Route::post('/deleteMultipleUser', [AdminController::class,'deleteMultipleUser'])->name('deleteMultipleUser');


    Route::post('/addCourse', [AdminController::class, 'addCourse'])->name('addCourse');
    Route::post('/editCourse', [AdminController::class, 'editCourse'])->name('editCourse');
    Route::post('/deleteCourse', [AdminController::class, 'deleteCourse'])->name('deleteCourse');


    Route::post('/addStudent', [AdminController::class, 'addStudent'])->name('addStudent');
    Route::post('/editStudent', [AdminController::class, 'editStudent'])->name('editStudent');
    Route::post('/deleteStudent', [AdminController::class, 'deleteStudent'])->name('deleteStudent');
    Route::post('/users/bulk-delete', [AdminController::class, 'bulkDeleteUsers'])->name('bulkDeleteUsers');
    Route::post('/courses/bulk-delete', [AdminController::class, 'bulkDeleteCourses'])->name('bulkDeleteCourses');
    Route::post('/students/bulk-delete', [AdminController::class, 'bulkDeleteStudents'])->name('bulkDeleteStudents');

    Route::post('/updateName', [AdminController::class, 'updateName'])->name('updateName');
    Route::post('/updatePassword', [AdminController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/updateProfile', [AdminController::class, 'updateProfile'])->name('updateProfile');
});

// ********** Teacher Routes *********
Route::group(['prefix' => 'teacher', 'middleware' => ['web', 'isTeacher']], function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard']);
    Route::get('/course', [TeacherController::class, 'course'])->name('teacher.course');
    Route::get('/students', [TeacherController::class, 'students'])->name('teacher.students');

    Route::post('/addCourse', [TeacherController::class, 'addCourse'])->name('taddCourse');
    Route::post('/editCourse', [TeacherController::class, 'editCourse'])->name('teditCourse');
    Route::post('/deleteCourse', [TeacherController::class, 'deleteCourse'])->name('tdeleteCourse');


    Route::post('/addStudent', [TeacherController::class, 'addStudent'])->name('taddStudent');
    Route::post('/editStudent', [TeacherController::class, 'editStudent'])->name('teditStudent');
    Route::post('/deleteStudent', [TeacherController::class, 'deleteStudent'])->name('tdeleteStudent');
    Route::post('/courses/bulk-delete', [TeacherController::class, 'bulkDeleteCourses'])->name('tbulkDeleteCourses');
    Route::post('/students/bulk-delete', [TeacherController::class, 'bulkDeleteStudents'])->name('tbulkDeleteStudents');

    Route::post('/updateName', [TeacherController::class, 'updateName'])->name('tupdateName');
    Route::post('/updatePassword', [TeacherController::class, 'updatePassword'])->name('tupdatePassword');
    Route::post('/updateProfile', [TeacherController::class, 'updateProfile'])->name('tupdateProfile');
});

// ********** Student Routes *********
Route::group(['middleware' => ['web', 'isStudent']], function () {
    Route::get('/home', [StudentsController::class, 'dashboard']);
    Route::post('/enrollStudent', [StudentsController::class, 'enrollStudent'])->name('enrollStudent');
    Route::get('/profile', [StudentsController::class, 'profile'])->name('profile');

    Route::post('/updateName', [StudentsController::class, 'updateName'])->name('supdateName');
    Route::post('/updatePassword', [StudentsController::class, 'updatePassword'])->name('supdatePassword');
    Route::post('/updateProfile', [StudentsController::class, 'updateProfile'])->name('supdateProfile');
});


// Secure Route to Storage folder (with path traversal protection)
Route::get('storage/{filename}', function ($filename) {
    if (str_contains($filename, '..') || str_starts_with($filename, '/') || str_starts_with($filename, '\\')) {
        abort(404);
    }

    $baseDirs = [
        storage_path('app/public'),
        storage_path('public'),
    ];

    $resolvedPath = null;
    foreach ($baseDirs as $baseDir) {
        $candidate = $baseDir . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $filename);
        $realCandidate = realpath($candidate);
        $realBaseDir = realpath($baseDir);

        if ($realCandidate && $realBaseDir && str_starts_with($realCandidate, $realBaseDir) && File::exists($realCandidate)) {
            $resolvedPath = $realCandidate;
            break;
        }
    }

    if (!$resolvedPath || !File::isFile($resolvedPath)) {
        abort(404);
    }

    $file = File::get($resolvedPath);
    $type = File::mimeType($resolvedPath) ?: 'application/octet-stream';

    $response = Response::make($file, 200);
    $response->header('Content-Type', $type);

    return $response;
})->where('filename', '.*');

