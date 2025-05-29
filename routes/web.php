<?php

use App\Http\Controllers\{ItemController, BugsController, CharacterController, MainController,
    ProfileController, ModesController, MistakeController, ChangesController,
    BlogController, HistoryController, ConsoleController, AdminController};
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureIsAdmin;

// Публичные маршруты
Route::get('/', [MainController::class, 'index'])->name('main_page');
Route::get('/character/{id}', [CharacterController::class, 'show'])->name('character.show');
Route::get('/items', [ItemController::class, 'item'])->name('items');
Route::get('/bugs', [BugsController::class, 'bugs'])->name('bugs_list');
Route::get('/bugs/{id}', [BugsController::class, 'bugs_detail'])->name('bugs_detail');
Route::get('/modes', [ModesController::class, 'modes'])->name('modes');
Route::get('/changes', [ChangesController::class, 'changes'])->name('changes');
Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::get('/history', [HistoryController::class, 'histories'])->name('histories');
Route::get('/history/{id}', [HistoryController::class, 'history'])->name('history_detail');
Route::get('/console', [ConsoleController::class, 'console'])->name('console');
Route::post('/mistakes', [MistakeController::class, 'store'])->name('mistakes.store');

// Авторизованные маршруты
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Профиль пользователя
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Админ-маршруты
Route::middleware(['auth', EnsureIsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'admin'])->name('admin');


    Route::get('/items', [AdminController::class, 'items'])->name('admin.items');

    Route::prefix('bugs')->group(function () {
        Route::get('/', [BugsController::class, 'index'])->name('admin.bugs');
        Route::get('/create', [BugsController::class, 'create'])->name('admin.bugs.create');
        Route::post('/', [BugsController::class, 'store'])->name('admin.bugs.store');
        Route::get('/{id}/edit', [BugsController::class, 'edit'])->name('admin.bugs.edit');
        Route::put('/{id}', [BugsController::class, 'update'])->name('admin.bugs.update');
        Route::delete('/{id}', [BugsController::class, 'destroy'])->name('admin.bugs.destroy');
    });

    Route::prefix('histories')->group(function () {
        Route::get('/', [HistoryController::class, 'index'])->name('admin.histories');
        Route::get('/create', [HistoryController::class, 'create'])->name('admin.histories.create');
        Route::post('/', [HistoryController::class, 'store'])->name('admin.histories.store');
        Route::get('/{id}/edit', [HistoryController::class, 'edit'])->name('admin.histories.edit');
        Route::put('/{id}', [HistoryController::class, 'update'])->name('admin.histories.update');
        Route::delete('/{id}', [HistoryController::class, 'destroy'])->name('admin.histories.destroy');
    });

    Route::get('/modes', [AdminController::class, 'modes'])->name('admin.modes');
    Route::get('/console', [AdminController::class, 'console'])->name('admin.console');
    Route::get('/changes', [AdminController::class, 'changes'])->name('admin.changes');
    Route::get('/blog', [AdminController::class, 'blog'])->name('admin.blog');
    Route::get('/mistakes', [AdminController::class, 'mistakes'])->name('admin.mistakes');

    // Управление ошибками
    Route::prefix('mistakes')->group(function () {
        Route::put('/{mistake}', [MistakeController::class, 'update'])->name('admin.mistakes.update');
        Route::delete('/{mistake}', [MistakeController::class, 'destroy'])->name('admin.mistakes.destroy');
    });

    // Управление персонажами
    Route::prefix('characters')->group(function () {
        Route::get('/', [AdminController::class, 'admin'])->name('admin.characters.index');
        Route::get('/{character}/edit', [AdminController::class, 'character'])
            ->name('admin.characters.edit');
        Route::put('/{character}', [CharacterController::class, 'update'])
            ->name('admin.characters.update');
    });
});

require __DIR__.'/auth.php';
