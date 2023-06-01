<?php
    Route::prefix('administrator')
    ->middleware(['auth'])
    ->group(function () {
  
          Route::get('/dashboard', function () {
          return view('admin.index');
          })->name('admin.dashboard');
          Route::get('/users', function () {
          return view('admin.users');
          })->name('admin.users');
          Route::get('/grade-level', function () {
          return view('admin.grade-level');
          })->name('admin.grade-level');
           Route::get('/subjects', function () {
           return view('admin.subjects');
           })->name('admin.subjects');
            Route::get('/strand', function () {
            return view('admin.strand');
            })->name('admin.strand');

             Route::get('/clearance', function () {
             return view('admin.clearance');
             })->name('admin.clearance');

      //Student
      Route::get('/students', function () {
      return view('admin.student');
      })->name('admin.student');

      //Teacher
      Route::get('/teacher', function () {
      return view('admin.teacher');
      })->name('admin.teacher');

    });
