<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [GroupController::class, 'show']);

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/group/{id}', [GroupController::class, 'showGroup'])->name('group_id');

Route::get("/add-student", [GroupController::class, 'showAddStudent'])->name('list_add_student');
Route::post("/add-student", [GroupController::class, 'addStudent'])->name('add_student');

Route::delete('/remove-student', [GroupController::class, 'removeStudent'])->name('remove_student');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
