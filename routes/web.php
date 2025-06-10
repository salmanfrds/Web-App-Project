<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\UserController;

//Root Directory
Route::get('/', [ActivityController::class, 'index'])->middleware(Authenticate::class);


//Login
Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);


//CRUD Activities
Route::get('/activities', [ActivityController::class, 'displayActivities'])->name('activities');

Route::get('/activities/add', [ActivityController::class, 'displayAdd']);

Route::post('/activities/add', [ActivityController::class, 'addActivity'])->name('activities.store');

Route::get('/activities/{id}', [ActivityController::class, 'viewActivity'])->name('activities.view');

Route::post('/activities/{id}/status', [ActivityController::class, 'editActivity'])->name('activities.edit');

Route::delete('/activities/{id}', [ActivityController::class, 'deleteActivity'])->name('activities.delete');


//CRUD User

//profile route by Naqash
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
});

// Registration Routes
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');


