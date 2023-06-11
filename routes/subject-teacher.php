<?php
    Route::prefix('subject-teacher')
  ->middleware(['auth','subject-teacher'])
    ->group(function () {
        
         Route::get('/dashboard', function () {
         return view('adviser.index');
         })->name('subject-teacher.dashboard');
       Route::get('/manage-students', function () {
       return view('adviser.manage.student');
       })->name('subject-teacher.student');
       Route::get('/manage-clearance/{id}', function () {
       return view('adviser.manage.clearance');
       })->name('subject-teacher.manage.clearance');
        Route::get('/profile', function () {
        return view('profile.edit');
        })->name('subject-teacher.profile');
    });
