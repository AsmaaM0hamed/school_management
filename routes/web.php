<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\GradeController;
use App\Http\Controllers\Backend\ClassroomController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\SpecializationController;
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
    });
});

require __DIR__.'/auth.php';
