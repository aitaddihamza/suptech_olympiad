<?php

use App\Http\Controllers\admin\ActivityController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\participant\ParticipantController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\ParticipantAccess;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/matches', [HomeController::class, 'matches'])->name('home.matches');
Route::get('/classements', [HomeController::class, 'classements'])->name('home.classements');

# admin routes
Route::prefix('/admin')->middleware(['auth', 'verified', AdminAccess::class])->controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('admin.dashboard');
    Route::prefix('/game')->group(function () {
        Route::get('/', 'games')->name('admin.game.index');
        Route::get('/create', 'create_game')->name('admin.game.create');
        Route::post('/', 'store_game')->name('admin.game.store');
        Route::get('/{game}/edit', 'edit_game')->name('admin.game.edit');
        Route::put('/{game}/update', 'update_game')->name('admin.game.update');
        Route::delete('/{game}', 'destroy_game')->name('admin.game.destroy');
    });
    Route::prefix('/participant')->group(function () {
        Route::get('/', 'participants')->name('admin.participant.index');
    });

    # activity crud
    Route::prefix('/activity')->controller(ActivityController::class)->group(function () {
        Route::get('/', 'index')->name('admin.activity.index');
        Route::get('/planing/{activity}', 'planing')->name('admin.activity.planing');
        Route::put('/planing/{activity}', 'update_planing')->name('admin.activity.update_planing');
    });
});

# particiapnt routes
Route::prefix('/participant')->controller(ParticipantController::class)->middleware(['auth', 'verified', ParticipantAccess::class])->group(function () {
    Route::get('/dashboard', 'index')->name('participant.dashboard');
    Route::prefix('/game')->group(function () {
        Route::get('/', 'games')->name('participant.games');
    });
    Route::prefix('/activity')->group(function () {
        Route::get('/', 'activities')->name('participant.activities');
        Route::post('/{activity}', 'participate')->name('participant.activity.participate');
        Route::delete('/{activity}', 'cancel')->name('participant.activity.cancel');
    });
});


# profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
