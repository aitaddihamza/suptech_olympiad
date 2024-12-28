<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\organisator\OrganisatorController;
use App\Http\Controllers\participant\ParticipantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\participant\activity\ActivityController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\OrganisatorAccess;
use App\Http\Middleware\ParticipantAccess;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

# admin routes
Route::prefix('/admin')->middleware(['auth', 'verified', AdminAccess::class])->controller(AdminController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('admin.dashboard');
    # gestion des organisators
    Route::get('/organisator', 'organisators')->name('admin.organisators');
    Route::get('/organisator/create', 'create_organisator')->name('admin.create_organisator');
    Route::post('/organisator/create', 'store_organisator')->name('admin.store_organisator');
    Route::get('/organisator/show/{id}', 'show_organisator')->name('admin.show_organisator');
    Route::get('/organisator/edit/{organisator}', 'edit_organisator')->name('admin.edit_organisator');
    Route::put('/organisator/edit/{organisator}', 'update_organisator')->name('admin.update_organisator');
    Route::delete('/organisator/{organisator}', 'destroy_organisator')->name('admin.destroy_organisator');

    # gestion des activities
    Route::get('/activity', 'activities')->name('admin.activities');
    Route::get('/activity/create', 'create_activity')->name('admin.create_activity');
    Route::post('/activity/create', 'store_activity')->name('admin.store_activity');
    Route::get('/activity/edit/{activity}', 'edit_activity')->name('admin.edit_activity');
    Route::put('/activity/edit/{activity}', 'update_activity')->name('admin.update_activity');
    Route::delete('/activity/{activity}', 'destroy_activity')->name('admin.destroy_activity');
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

# organisator routes
Route::get('/organisator/dashboard', [OrganisatorController::class, 'index'])->middleware(['auth', 'verified', OrganisatorAccess::class])->name('organisator.dashboard');

# profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
