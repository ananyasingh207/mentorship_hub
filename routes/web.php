<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StartupProfileController;
use App\Http\Controllers\MentorProfileController;
use App\Http\Controllers\AdminMentorController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StartupRequestController;
use App\Http\Controllers\MentorRequestController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');
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

        // Startup Requests
        Route::get('/mentors/{mentor}/request', [StartupRequestController::class, 'create'])->name('startup.requests.create');
        Route::post('/mentors/{mentor}/request', [StartupRequestController::class, 'store'])->name('startup.requests.store');
        Route::get('/startup/requests', [StartupRequestController::class, 'index'])->name('startup.requests.index');

        // Startup Bookings
        Route::post('/bookings/{slot}', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/startup/bookings', [BookingController::class, 'startupIndex'])->name('startup.bookings.index');
        Route::patch('/startup/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('startup.bookings.cancel');

        // Startup Reviews
        Route::get('/mentors/{mentor}/review', [ReviewController::class, 'create'])->name('reviews.create');
        Route::post('/mentors/{mentor}/review', [ReviewController::class, 'store'])->name('reviews.store');
    });
});

Route::middleware(['auth', 'role:mentor'])->group(function () {
    Route::get('/mentor/profile/create', [MentorProfileController::class, 'create'])->name('mentor.profile.create');
    Route::post('/mentor/profile/store', [MentorProfileController::class, 'store'])->name('mentor.profile.store');

    Route::middleware(['profile.completed', 'mentor.approved'])->group(function () {
        Route::get('/mentor/dashboard', function () {
            return view('mentor.dashboard');
        })->name('mentor.dashboard');

        Route::get('/mentor/rejected', function () {
            return view('mentor.rejected');
        })->name('mentor.rejected');

        // Mentor Requests
        Route::get('/mentor/requests', [MentorRequestController::class, 'index'])->name('mentor.requests.index');
        Route::patch('/mentor/requests/{mentorRequest}/accept', [MentorRequestController::class, 'accept'])->name('mentor.requests.accept');
        Route::patch('/mentor/requests/{mentorRequest}/reject', [MentorRequestController::class, 'reject'])->name('mentor.requests.reject');

        // Mentor Time Slots & Bookings
        Route::get('/mentor/slots', [TimeSlotController::class, 'index'])->name('mentor.slots.index');
        Route::post('/mentor/slots', [TimeSlotController::class, 'store'])->name('mentor.slots.store');
        Route::get('/mentor/bookings', [BookingController::class, 'mentorIndex'])->name('mentor.bookings.index');
        Route::patch('/mentor/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('mentor.bookings.complete');

        // Mentor Reviews Dashboard
        Route::get('/mentor/reviews', [ReviewController::class, 'mentorIndex'])->name('mentor.reviews.index');
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
