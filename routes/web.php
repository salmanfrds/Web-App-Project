<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;

//Root Directory
Route::get('/', [ActivityController::class, 'index']);


//Login
Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [ActivityController::class, 'login'])->name('login');


//CRUD Activities
Route::get('/activities', [ActivityController::class, 'displayActivities'])->name('activities');

Route::get('/activities/add', function(){
    return view('add');
});

Route::post('/activities', [ActivityController::class, 'addActivity'])->name('activities.store');

Route::get('/activities/{id}', [ActivityController::class, 'viewActivity'])->name('activities.view');

Route::post('/activities/{id}/status', [ActivityController::class, 'editActivity'])->name('activities.edit');

Route::delete('/activities/{id}', [ActivityController::class, 'deleteActivity'])->name('activities.delete');


//
