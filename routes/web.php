<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\GradeController;
use App\Http\Controllers\Backend\ClassroomController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\SpecializationController;
use App\Http\Controllers\Backend\ParentController;
use App\Http\Controllers\Backend\StudentController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function() {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('backend/dashboard', function () {
        return view('backend.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        // Grades Routes
        Route::resource('backend/grades', GradeController::class);
        
        // Classrooms Routes
        Route::resource('backend/classrooms', ClassroomController::class);
        
        // Sections Routes
        Route::resource('backend/sections', SectionController::class);
        Route::get('backend/get-classrooms/{grade_id}', [SectionController::class, 'getClassrooms'])->name('get.classrooms');
        
        // Teachers Routes
        Route::resource('backend/teachers', TeacherController::class);
        
        // Specializations Routes
        Route::resource('backend/specializations', SpecializationController::class);
        
        // Parents Routes
        Route::resource('parents', ParentController::class);
        
        // Students Routes
        Route::resource('students', StudentController::class);
        Route::get('students/get-classrooms/{grade_id}', [StudentController::class, 'getClassrooms']);
        Route::get('students/get-sections/{classroom_id}', [StudentController::class, 'getSections']);
    });
});

require __DIR__.'/auth.php';
