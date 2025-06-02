<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

Route::get('/', function () {
    return view('login');
});

Route::get('/activities', [ActivityController::class, 'index']);

Route::get('/activities/add', function(){
    return view('add');
});

Route::post('/activities', [ActivityController::class, 'addActivity'])->name('activities.store');

Route::get('/activities/something')->name('sambalgepuk');
