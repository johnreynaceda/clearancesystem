<?php
    Route::prefix('student')
  ->middleware(['auth','student'])
    ->group(function () {
         Route::get('/dashboard', function () {
         return view('student.index');
         })->name('student.dashboard');


    });
