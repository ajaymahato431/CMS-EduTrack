<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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


Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', function () {
    return redirect('/');
});
Route::get('/', [AuthController::class, 'loadLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

// ********** Admin Routes *********
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'isAdmin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/users', [AdminController::class, 'users'])->name('AdminUsers');
    Route::get('/manage-role', [AdminController::class, 'manageRole'])->name('manageRole');
    Route::post('/update-role', [AdminController::class, 'updateRole'])->name('updateRole');
    Route::get('/course', [AdminController::class, 'course'])->name('Course');
    Route::get('/students', [AdminController::class, 'students'])->name('Students');

    Route::post('/editUser', [AdminController::class, 'editUser'])->name('editUser');
    Route::post('/deleteUser', [AdminController::class, 'deleteUser'])->name('deleteUser');
    // Route::post('/deleteMultipleUser', [AdminController::class,'deleteMultipleUser'])->name('deleteMultipleUser');


    Route::post('/addCourse', [AdminController::class, 'addCourse'])->name('addCourse');
    Route::post('/editCourse', [AdminController::class, 'editCourse'])->name('editCourse');
    Route::post('/deleteCourse', [AdminController::class, 'deleteCourse'])->name('deleteCourse');


    Route::post('/addStudent', [AdminController::class, 'addStudent'])->name('addStudent');
    Route::post('/editStudent', [AdminController::class, 'editStudent'])->name('editStudent');
    Route::post('/deleteStudent', [AdminController::class, 'deleteStudent'])->name('deleteStudent');

    Route::post('/updateName', [AdminController::class, 'updateName'])->name('updateName');
    Route::post('/updatePassword', [AdminController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/updateProfile', [AdminController::class, 'updateProfile'])->name('updateProfile');
});

// ********** Teacher Routes *********
Route::group(['prefix' => 'teacher', 'middleware' => ['web', 'isTeacher']], function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard']);
    Route::get('/course', [TeacherController::class, 'course'])->name('Course');
    Route::get('/students', [TeacherController::class, 'students'])->name('Students');

    Route::post('/addCourse', [TeacherController::class, 'addCourse'])->name('taddCourse');
    Route::post('/editCourse', [TeacherController::class, 'editCourse'])->name('teditCourse');
    Route::post('/deleteCourse', [TeacherController::class, 'deleteCourse'])->name('tdeleteCourse');


    Route::post('/addStudent', [TeacherController::class, 'addStudent'])->name('taddStudent');
    Route::post('/editStudent', [TeacherController::class, 'editStudent'])->name('teditStudent');
    Route::post('/deleteStudent', [TeacherController::class, 'deleteStudent'])->name('tdeleteStudent');

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


// Route to Storage folder
Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});
