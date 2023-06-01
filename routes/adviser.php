<?php
    Route::prefix('adviser')
    ->middleware(['auth'])
    ->group(function () {
        
         Route::get('/dashboard', function () {
         return view('adviser.index');
         })->name('adviser.dashboard');
         Route::get('/manage-students', function () {
         return view('adviser.manage.student');
         })->name('adviser.student');
          Route::get('/manage-clearance/{id}', function () {
          return view('adviser.manage.clearance');
          })->name('adviser.manage.clearance');
    });
