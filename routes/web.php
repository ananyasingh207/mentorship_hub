<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Role-based routes
Route::middleware(['auth', 'role:startup'])->group(function () {
    Route::get('/startup/dashboard', function () {
        return view('startup.dashboard');
    })->name('startup.dashboard');
});

Route::middleware(['auth', 'role:mentor'])->group(function () {
    Route::get('/mentor/dashboard', function () {
        return view('mentor.dashboard');
    })->name('mentor.dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

require __DIR__.'/auth.php';
