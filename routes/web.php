<?php

use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/statuses', [StatusController::class, 'index'])->name('statuses.index');
    Route::get('/statuses/create', [StatusController::class, 'create'])->name('statuses.create');
    Route::post('/statuses', [StatusController::class, 'store'])->name('statuses.store');
    Route::get('/statuses/{status}/edit', [StatusController::class, 'edit'])->name('statuses.edit');
    Route::put('/statuses/{status}', [StatusController::class, 'update'])->name('statuses.update');
    Route::delete('/statuses/{status}', [StatusController::class, 'destroy'])->name('statuses.delete');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
