<?php

use App\Http\Controllers\Admin\EnrollmentsController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Users\DisplaySubjectsController;
use App\Http\Controllers\Users\DisplayEnrolledSubjectsController;
use App\Http\Controllers\Users\DisplayPendingSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Users\EnrollSubjectController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['middleware' => 'can:admin'], function () {
        Route::resource('subjects', SubjectController::class);
        Route::resource('users', UserManagementController::class);

        Route::get('enrollments', [EnrollmentsController::class, 'index'])->name('enrollments.index');
        Route::put('update-status/{subject}/{user}', [EnrollmentsController::class, 'update'])->name('enrollments.update');
        Route::delete('enrollment/{subject}/{user}', [EnrollmentsController::class, 'destroy'])->name('enrollments.destroy');
    });

    Route::group(['middleware' => 'can:student'], function () {
        Route::get('view-approved-enrolled-subjects', DisplayEnrolledSubjectsController::class)->name('enrolled.subjects');
        Route::get('view-available-subjects', DisplaySubjectsController::class)->name('all.subjects');
        Route::get('view-pending-enrolled-subjects', DisplayPendingSubjectController::class)->name('pending.enrolled.subjects');

        Route::put('enroll-subject/{subject}', [EnrollSubjectController::class, 'enrollSubject'])->name('enroll.subject');
        Route::put('cancel-enroll-subject/{subject}', [EnrollSubjectController::class, 'cancelEnrollmentSubject'])->name('cancel.enroll.subject');
    });
});

require __DIR__ . '/auth.php';
