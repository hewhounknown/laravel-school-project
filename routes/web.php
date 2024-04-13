<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ProfileController;

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

require __DIR__.'/auth.php';

Route::get('/', [SchoolController::class, 'home']);
Route::get('home', [SchoolController::class, 'home'])->name('home');

Route::prefix('programmes')->group(function () {
    Route::get('{program}', [SchoolController::class, 'courseList'])->name('course.list');
    Route::get('courses/filter', [SchoolController::class, 'filterCourses']);
});

Route::middleware('auth')->group(function(){
    Route::get('profile', [AuthController::class, 'profileForm'])->name('profile');
    Route::post('profile', [AuthController::class, 'editProfile']);
    Route::post('password/change', [AuthController::class, 'changePassword'])->name('password.change');

    Route::get('teacher/categories/take', [CourseController::class, 'takeCategories']);
    Route::get('select/choices', [SchoolController::class, 'selectChoices']);

    Route::prefix('course')->group(function() {
        Route::get('detail/{id}', [SchoolController::class, 'detailCourse'])->name('course.detail');

        Route::get('enroll/{id}', [SchoolController::class, 'enrollCourse'])->name('course.enroll');
        Route::get('unenroll/{id}', [SchoolController::class, 'unenrollCourse'])->name('course.unenroll');

        Route::get('topic/content/view/{contentId}', [SchoolController::class, 'content'])->name('contentView');

        Route::post('review/create', [SchoolController::class, 'createReview'])->name('course.review.create');
        Route::get('review/delete/{id}', [SchoolController::class, 'deleteReview'])->name('course.review.delete');

        Route::middleware('teacher_middleware')->group(function(){
            Route::post('create', [CourseController::class, 'createCourse'])->name('teacher.course.create');
            Route::post('edit', [CourseController::class, 'editCourse'])->name('teacher.course.edit');
            Route::get('delete/{id}', [CourseController::class, 'deleteCourse'])->name('teacher.course.delete');

            Route::post('topic/create', [CourseController::class, 'createTopic'])->name('teacher.topic.create');
            Route::post('topic/content/add', [CourseController::class, 'addContent'])->name('teacher.content.add');
            Route::post('topic/content/edit/{contentId}', [CourseController::class, 'editContent'])->name('teacher.content.edit');
            Route::get('topic={topicId}/content/delete{contentId}', [SchoolController::class, 'deleteContent'])->name('content.delete');
        });

        Route::get('take/classmates', [CourseController::class, 'takeClassmates']);
    });

    Route::post('content/comment/write', [SchoolController::class, 'writeComment'])->name('content.comment.write');
    Route::get('content/comment/delete/{id}', [SchoolController::class, 'deleteComment'])->name('content.comment.delete');
    Route::get('download/{filename}', [SchoolController::class, 'downloadFile'])->name('file.download');

    Route::get('students/control', [SchoolController::class, 'studentTable'])->name('student.control');
    Route::get('accept/student={studentId}/for/course={courseName}', [SchoolController::class, 'acceptEnroll'])->name('student.accept');
    Route::get('kick/student={studentId}/from/course={courseName}', [SchoolController::class, 'kickStudent'])->name('student.kick');

    Route::get('profile/view/{id}', [SchoolController::class, 'viewProfile'])->name('profile.view');

    Route::prefix('library')->group(function() {
        Route::get('center', [LibraryController::class, 'center'])->name('library')->withoutMiddleware('auth');
        Route::get('view/book/{bookId}', [LibraryController::class, 'readBook'])->name('book.view');
        Route::post('add/book', [LibraryController::class, 'addBook'])->name('book.add');
    });

    Route::group(['prefix'=> 'admin', 'middleware' => 'admin_middleware'], function() {

        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('manage/users', [AdminController::class, 'manageUsers'])->name('users.manage');
        Route::get('delete/user={id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
        Route::get('change/user={id}/to/role={role}', [AdminController::class, 'changeRole'])->name('admin.user.role');
        Route::get('change/user={id}/to/status={status}', [AdminController::class, 'changeStatus'])->name('admin.user.status');
        Route::get('search/user', [AdminController::class, 'searchUsers']);
        Route::get('detail/user={id}', [AdminController::class, 'detailUser'])->name('admin.user.detail');

        Route::get('manage/library', [AdminController::class, 'manageLibrary'])->name('library.manage');
        Route::post('add/book/libatary', [AdminController::class, 'addBook'])->name('admin.book.add');
        Route::get('public/book={id}', [AdminController::class, 'publicBook'])->name('book.public');
        Route::get('view/bookslist', [AdminController::class, 'booksList'])->name('book.list');
        Route::get('search/book', [AdminController::class, 'searchBook']);
        Route::get('read/book={id}', [LibraryController::class, 'readBook'])->name('admin.book.read');


        Route::get('manage/programs', [AdminController::class, 'managePrograms'])->name('programs.manage');
        Route::post('create/program', [AdminController::class, 'createProgram'])->name('program.create');
        Route::post('edit/program={id}', [AdminController::class, 'editProgram'])->name('program.edit');

        Route::get('manage/cources', [AdminController::class, 'manageCourses'])->name('admin.courses.manage');
        Route::get('take/categories', [AdminController::class, 'takeCategories']);
        Route::get('search/course', [AdminController::class, 'searchCourse']);
        Route::post('create/course', [CourseController::class, 'createCourse'])->name('admin.course.create');
        Route::get('public/course={id}', [AdminController::class, 'publicCourse'])->name('admin.course.public');
        Route::get('unpublic/course={id}', [AdminController::class, 'unpublicCourse'])->name('admin.course.unpublic');
        Route::get('detail/course={id}', [AdminController::class, 'detailCourse'])->name('admin.course.detail');
        Route::post('edit/course', [CourseController::class, 'editCourse'])->name('admin.course.edit');
        Route::get('delete/course={id}', [CourseController::class, 'deleteCourse'])->name('admin.course.delete');

        Route::post('create/topic/', [CourseController::class, 'createTopic'])->name('admin.topic.create');
        Route::post('add/content/topic', [CourseController::class, 'addContent'])->name('admin.content.add');
        Route::get('view/content={id}', [AdminController::class, 'viewContent'])->name('admin.content.view');
        Route::post('edit/content={id}', [CourseController::class, 'editContent'])->name('admin.content.edit');
        Route::get('delete/content={id}/in/{topicId}', [AdminController::class, 'deleteContent'])->name('admin.content.delete');

        Route::get('view/profile', [AuthController::class, 'profileForm'])->name('admin.profile.view');
    });

    Route::get('show/pdf={id}', [LibraryController::class, 'showPDF'])->name('pdf.show');
});


