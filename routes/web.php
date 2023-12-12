<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;

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
Route::get('course/detail/name={name}', [SchoolController::class, 'detailCourse'])->name('courseDetail');
Route::post('course/name={name}/add/topic', [SchoolController::class, 'addTopic'])->name('topicAdd');
Route::post('course/topic={name}/add/content', [SchoolController::class, 'addContent'])->name('contentAdd');
Route::get('course/topic={name}/view/content={title}', [SchoolController::class, 'content'])->name('contentView');

Route::get('download/{filename}', [SchoolController::class, 'downloadFile'])->name('file.download');

Route::prefix('programmes')->group(function () {
    Route::get('languages', [SchoolController::class, 'languagesPage'])->name('languages');
    Route::get('languages/class={title}', [SchoolController::class, 'coursesDetail'])->name('coursesDetail');
});
