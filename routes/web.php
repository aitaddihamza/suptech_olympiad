<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\participant\ParticipantController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\ParticipantAccess;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

# admin routes
Route::prefix('/admin')->middleware(['auth', 'verified', AdminAccess::class])->controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('admin.dashboard');
});

# particiapnt routes
Route::prefix('/participant')->middleware(['auth', 'verified', ParticipantAccess::class])->group(function () {
    Route::get('/dashboard', [ParticipantController::class, 'index'])->name('participant.dashboard');
    Route::prefix('/activity')->controller(ActivityController::class)->group(function () {
        Route::get('/', 'index')->name('participant.activities');
        Route::post('/{id}', 'participer')->name('participant.activity.participer');
        Route::delete('/{activity}', 'annuler')->name('participant.activity.annuler');
    });
});


# profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
