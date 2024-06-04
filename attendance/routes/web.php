<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('layouts.app');
});

Route::middleware(['web'])->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index']);
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index']);
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::get('', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
    Route::get('/userlist', [App\Http\Controllers\AdminController::class, 'show'])->name('admin.userlist');
    Route::get('/user/{id}', [App\Http\Controllers\AdminController::class, 'showUserDetails'])->name('admin.userdetails');
    Route::get('/add', [App\Http\Controllers\AdminController::class, 'showAddForm']);
    Route::post('/add', [App\Http\Controllers\AdminController::class, 'create'])->name('admin.adduser');
    Route::get('import', [App\Http\Controllers\AdminController::class, 'showImportForm']);
    Route::post('import', [App\Http\Controllers\AdminController::class, 'import'])->name('admin.import');
    Route::post('/user/{id}/soft-delete', [App\Http\Controllers\AdminController::class, 'softDeleteUser'])->name('admin.softdelete');
    Route::post('/user/{id}/force-delete', [App\Http\Controllers\AdminController::class, 'forceDeleteUser'])->name('admin.forcedelete');
    Route::post('/user/{id}/restore', [App\Http\Controllers\AdminController::class, 'restoreUser'])->name('admin.restore');
    Route::get('/pending', [App\Http\Controllers\AdminController::class, 'pendingUser'])->name('admin.pending');
    Route::post('/approve-user/{id}', [App\Http\Controllers\AdminController::class, 'approveUser'])->name('admin.approveUser');
    Route::delete('/delete-user/{id}', [App\Http\Controllers\AdminController::class, 'deletePendingUser'])->name('admin.deleteUser');
});
Route::prefix('student')->group(function () {
    Route::get('', [App\Http\Controllers\StudentController::class, 'index'])->name('student.home');
});
// Route::middleware(['role:admin'])->group(function () {
//     Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
// });


// Route::middleware(['role:student'])->group(function () {
//     Route::get('/student', function () {
//         return view('student.home');
//     });
// });
