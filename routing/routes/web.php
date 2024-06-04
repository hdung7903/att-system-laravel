<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/login',[UserController::class, 'login']);
Route::post('/login',[UserController::class, 'handleLogin'])->name('login');

Route::get('/register',[UserController::class, 'register']);
Route::post('/register',[UserController::class, 'handleRegister'])->name('register');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/{name?}', function (string $name=null) {
    return $name;
});