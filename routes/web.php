<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\GradeController;
use App\Http\Controllers\Backend\ClassroomController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\SpecializationController;
use App\Http\Controllers\Backend\ParentController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\PromotionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        // Default dashboard redirect
        Route::get('/dashboard', function () {
            return redirect()->route('backend.dashboard');
        })->name('dashboard');

        Route::prefix('backend')->name('backend.')->group(function () {
            // Dashboard Route
            Route::get('/dashboard', function () {
                return view('backend.dashboard');
            })->name('dashboard');

            // Profile Routes
            Route::controller(ProfileController::class)->group(function () {
                Route::get('/profile', 'edit')->name('profile.edit');
                Route::patch('/profile', 'update')->name('profile.update');
                Route::delete('/profile', 'destroy')->name('profile.destroy');
            });

            // Authentication Routes
            Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

            // Resource Routes
            Route::resource('grades', GradeController::class);
            Route::resource('classrooms', ClassroomController::class);
            Route::resource('sections', SectionController::class);
            Route::resource('students', StudentController::class);
            Route::resource('teachers', TeacherController::class);
            Route::resource('specializations', SpecializationController::class);
            Route::resource('parents', ParentController::class);

            // Promotions Routes - Make sure these routes are defined before the resource route
            Route::get('promotions/manage', [PromotionController::class, 'manage'])->name('promotions.manage');
            Route::delete('promotions/{promotion}/revert', [PromotionController::class, 'revertPromotion'])->name('promotions.revert');
            Route::delete('promotions/bulk-revert', [PromotionController::class, 'bulkRevert'])->name('promotions.bulk-revert');
            Route::resource('promotions', PromotionController::class)->except(['show']);

            // Additional Routes
            Route::get('sections/get-classrooms/{grade_id}', [SectionController::class, 'getClassrooms'])->name('sections.get-classrooms');
            Route::get('students/get-classrooms/{grade_id}', [StudentController::class, 'getClassrooms'])->name('students.get-classrooms');
            Route::get('students/get-sections/{classroom_id}', [StudentController::class, 'getSections'])->name('students.get-sections');
        });
    });
});

require __DIR__.'/auth.php';
