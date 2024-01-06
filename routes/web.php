<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\LibraryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [SchoolController::class, 'home']);
Route::get('home', [SchoolController::class, 'home'])->name('home');
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('profile', [AuthController::class, 'profileForm'])->name('profile');
Route::post('profile', [AuthController::class, 'editProfile']);

Route::get('course/create/{id}', [SchoolController::class, 'courseForm'])->name('courseForm');
Route::post('course/create', [SchoolController::class, 'createCourse'])->name('courseCreate');
Route::get('course/detail/{id}', [SchoolController::class, 'detailCourse'])->name('courseDetail');
Route::post('course/name={name}/add/topic', [SchoolController::class, 'addTopic'])->name('topicAdd');
Route::post('course/topic={name}/add/content', [SchoolController::class, 'addContent'])->name('contentAdd');
Route::get('course/topic={topicId}/view/content={contentId}', [SchoolController::class, 'content'])->name('contentView');
Route::post('course/topic={topicId}/edit/content={contentId}', [SchoolController::class, 'editContent'])->name('contentEdit');
Route::get('course/topic={topicId}/delete/content={contentId}', [SchoolController::class, 'deleteContent'])->name('content.delete');
Route::get('download/{filename}', [SchoolController::class, 'downloadFile'])->name('file.download');

Route::get('enroll/course={id}', [SchoolController::class, 'enrollCourse'])->name('course.enroll');
Route::get('unenroll/course={id}', [SchoolController::class, 'unenrollCourse'])->name('course.unenroll');

Route::get('control/students', [SchoolController::class, 'studentTable'])->name('student.control');
Route::get('accept/student={studentId}/for/course={courseId}', [SchoolController::class, 'acceptEnroll'])->name('student.accept');
Route::get('kick/student={studentId}/from/course={courseId}', [SchoolController::class, 'kickStudent'])->name('student.kick');

Route::prefix('programmes')->group(function () {
    Route::get('{program}', [SchoolController::class, 'courseList'])->name('course.list');
    Route::get('languages/class={title}', [SchoolController::class, 'coursesDetail'])->name('coursesDetail');
});

Route::prefix('library')->group(function() {
    Route::get('center', [LibraryController::class, 'center'])->name('library');
    Route::get('view/book', [LibraryController::class, 'viewBook'])->name('book.view');
    Route::post('add/book', [LibraryController::class, 'addBook'])->name('book.add');
});

Route::prefix('admin')->group(function() {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('manage/users', [AdminController::class, 'manageUsers'])->name('users.manage');
});
