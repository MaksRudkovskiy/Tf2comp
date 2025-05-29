<?php

use App\Http\Controllers\{ItemController, BugsController, CharacterController, MainController,
    ProfileController, ModesController, MistakeController, ChangesController,
    BlogController, HistoryController, ConsoleController, AdminController};
use Illuminate\Support\Facades\Route;

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

    // Админ-маршруты
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'admin'])->name('admin');

        // Разделы админки
        Route::get('/characters', [AdminController::class, 'admin'])->name('admin');
        Route::get('/items', [AdminController::class, 'items'])->name('admin.items');
        Route::get('/bugs', [AdminController::class, 'bugs'])->name('admin.bugs');
        Route::get('/modes', [AdminController::class, 'modes'])->name('admin.modes');
        Route::get('/history', [AdminController::class, 'history'])->name('admin.history');
        Route::get('/console', [AdminController::class, 'console'])->name('admin.console');
        Route::get('/changes', [AdminController::class, 'changes'])->name('admin.changes');
        Route::get('/blog', [AdminController::class, 'blog'])->name('admin.blog');
        Route::get('/mistakes', [AdminController::class, 'mistakes'])->name('admin.mistakes');

        // Управление персонажами
        Route::get('/characters/{character}/edit', [AdminController::class, 'character'])
            ->name('admin.characters.edit');
        Route::put('/characters/{character}', [CharacterController::class, 'update'])
            ->name('admin.characters.update');
    });

    // Профиль пользователя
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
