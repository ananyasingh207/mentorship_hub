<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StartupProfileController;
use App\Http\Controllers\MentorProfileController;
use App\Http\Controllers\AdminMentorController;
use App\Http\Controllers\MentorController;
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
    Route::get('/startup/profile/create', [StartupProfileController::class, 'create'])->name('startup.profile.create');
    Route::post('/startup/profile/store', [StartupProfileController::class, 'store'])->name('startup.profile.store');

    Route::middleware('profile.completed')->group(function () {
        Route::get('/startup/dashboard', function () {
            return view('startup.dashboard');
        })->name('startup.dashboard');

        Route::get('/mentors', [MentorController::class, 'index'])->name('mentors.index');
        Route::get('/mentors/{mentor}', [MentorController::class, 'show'])->name('mentors.show');
    });
});

Route::middleware(['auth', 'role:mentor'])->group(function () {
    Route::get('/mentor/profile/create', [MentorProfileController::class, 'create'])->name('mentor.profile.create');
    Route::post('/mentor/profile/store', [MentorProfileController::class, 'store'])->name('mentor.profile.store');

    Route::middleware('profile.completed')->group(function () {
        Route::get('/mentor/dashboard', function () {
            return view('mentor.dashboard');
        })->name('mentor.dashboard');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/mentors', [AdminMentorController::class, 'index'])->name('admin.mentors.index');
    Route::patch('/admin/mentors/{mentor}/approve', [AdminMentorController::class, 'approve'])->name('admin.mentors.approve');
    Route::patch('/admin/mentors/{mentor}/reject', [AdminMentorController::class, 'reject'])->name('admin.mentors.reject');
});

require __DIR__.'/auth.php';
