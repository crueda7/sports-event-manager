<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.delete');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [RoleController::class, 'index'])->name('users.index');
    Route::get('/users/create', [RoleController::class, 'create'])->name('users.create');
    Route::post('/users', [RoleController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [RoleController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [RoleController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [RoleController::class, 'destroy'])->name('users.delete');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
