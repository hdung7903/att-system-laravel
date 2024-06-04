<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [UserController::class, 'login']);

Route::post('/login', [UserController::class, 'handleLogin'])->name('login');


Route::middleware(['web'])->group(function () {
    Auth::routes();
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/product', function () {
        return view('product');
    });
});

Route::post('/logout', [UserController::class, 'handleLogout'])->name('logout');

Route::get('/list', function () {
    return view('todolist.list');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('todolist', TodolistController::class);
    Route::get('list', [TodolistController::class, 'index'])->name('todolist.list');
    Route::post('todolist/{id}/toggle-status', [TodolistController::class, 'toggleStatus'])->name('todolist.toggleStatus');
    Route::get('todolist/filter', [TodolistController::class, 'filter'])->name('todolist.filter');
});