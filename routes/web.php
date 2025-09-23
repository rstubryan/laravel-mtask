<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/{id}', [ProjectController::class, 'show'])->name('projects.show');
        Route::put('/{id}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });

    Route::prefix('tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
        Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/{id}', [TaskController::class, 'show'])->name('tasks.show');
        Route::put('/{id}', [TaskController::class, 'update'])->name('tasks.update');
        Route::patch('/{id}', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
        Route::delete('/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    });

    Route::prefix('groups')->group(function () {
        Route::get('/', [App\Http\Controllers\GroupController::class, 'index'])->name('groups.index');
        Route::post('/', [App\Http\Controllers\GroupController::class, 'store'])->name('groups.store');
        Route::get('/{id}', [App\Http\Controllers\GroupController::class, 'show'])->name('groups.show');
        Route::put('/{id}', [App\Http\Controllers\GroupController::class, 'update'])->name('groups.update');
        Route::delete('/{id}', [App\Http\Controllers\GroupController::class, 'destroy'])->name('groups.destroy');
    });

    Route::prefix('grouptasks')->group(function () {
        Route::get('/', [App\Http\Controllers\GroupTaskController::class, 'index'])->name('grouptasks.index');
        Route::post('/', [App\Http\Controllers\GroupTaskController::class, 'store'])->name('grouptasks.store');
        Route::get('/{id}', [App\Http\Controllers\GroupTaskController::class, 'show'])->name('grouptasks.show');
        Route::put('/{id}', [App\Http\Controllers\GroupTaskController::class, 'update'])->name('grouptasks.update');
        Route::delete('/{id}', [App\Http\Controllers\GroupTaskController::class, 'destroy'])->name('grouptasks.destroy');
    });

    Route::prefix('issues')->group(function () {
        Route::get('/', [App\Http\Controllers\IssueController::class, 'index'])->name('issues.index');
        Route::post('/', [App\Http\Controllers\IssueController::class, 'store'])->name('issues.store');
        Route::get('/{id}', [App\Http\Controllers\IssueController::class, 'show'])->name('issues.show');
        Route::put('/{id}', [App\Http\Controllers\IssueController::class, 'update'])->name('issues.update');
        Route::patch('/{id}', [App\Http\Controllers\IssueController::class, 'updateStatus'])->name('issues.updateStatus');
        Route::delete('/{id}', [App\Http\Controllers\IssueController::class, 'destroy'])->name('issues.destroy');
    });
});

require __DIR__ . '/auth.php';
