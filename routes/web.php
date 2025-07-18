<?php

use App\Http\Controllers\{ItemController, BugsController, CharacterController, MainController,
    ProfileController, ModesController, MistakeController, ChangesController,
    BlogController, HistoryController, ConsoleController, AdminController, AdminItemController,
    StatsController, UsersController};
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureAdminAccess;
use App\Http\Middleware\EnsureModeratorAccess;

// Публичные маршруты
Route::get('/', [MainController::class, 'index'])->name('main_page');
Route::get('/faq', [MainController::class, 'faq'])->name('faq');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/character/{id}', [CharacterController::class, 'show'])->name('character.show');
Route::get('/items', [ItemController::class, 'item'])->name('items');
Route::get('/bugs', [BugsController::class, 'bugs'])->name('bugs_list');
Route::get('/bugs/{id}', [BugsController::class, 'bugs_detail'])->name('bugs_detail');
Route::get('/modes', [ModesController::class, 'index'])->name('modes');
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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Админ и модератор маршруты
Route::middleware(['auth', EnsureModeratorAccess::class])->prefix('admin')->group(function () {
    // Общие маршруты для админов и модераторов
    Route::get('/', [AdminController::class, 'admin'])->name('admin');

    Route::prefix('items')->group(function () {
        Route::get('/', [AdminItemController::class, 'index'])->name('admin.items');
        Route::get('/create', [AdminItemController::class, 'create'])->name('admin.items.create');
        Route::post('/', [AdminItemController::class, 'store'])->name('admin.items.store');
        Route::get('/{item}/edit', [AdminItemController::class, 'edit'])->name('admin.items.edit');
        Route::put('/{item}', [AdminItemController::class, 'update'])->name('admin.items.update');
        Route::delete('/{item}', [AdminItemController::class, 'destroy'])->name('admin.items.destroy');
    });
    // Маршруты только для админов
    Route::middleware(EnsureAdminAccess::class)->group(function () {
        Route::prefix('changes')->group(function () {
            Route::get('/', [ChangesController::class, 'index'])->name('admin.changes');
            Route::get('/create', [ChangesController::class, 'create'])->name('admin.changes.create');
            Route::post('/', [ChangesController::class, 'store'])->name('admin.changes.store');
            Route::get('/{id}/edit', [ChangesController::class, 'edit'])->name('admin.changes.edit');
            Route::put('/{id}', [ChangesController::class, 'update'])->name('admin.changes.update');
            Route::delete('/{id}', [ChangesController::class, 'destroy'])->name('admin.changes.destroy');
        });

        Route::prefix('blog')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('admin.blog');
            Route::get('/create', [BlogController::class, 'create'])->name('admin.blog.create');
            Route::post('/', [BlogController::class, 'store'])->name('admin.blog.store');
            Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
            Route::put('/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
            Route::delete('/{id}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');
        });

        Route::get('/mistakes', [AdminController::class, 'mistakes'])->name('admin.mistakes');
        Route::prefix('mistakes')->group(function () {
            Route::put('/{mistake}', [MistakeController::class, 'update'])->name('admin.mistakes.update');
            Route::delete('/{mistake}', [MistakeController::class, 'destroy'])->name('admin.mistakes.destroy');
        });

        Route::get('/stats', [StatsController::class, 'index'])->name('admin.stats');
        Route::get('/admin/stats/export', [StatsController::class, 'exportToWord'])
            ->name('admin.stats.export')
            ->middleware(['auth', EnsureAdminAccess::class]);

        Route::prefix('users')->group(function () {
            Route::get('/', [UsersController::class, 'index'])->name('admin.users');
            Route::post('/{user}/ban', [UsersController::class, 'ban'])->name('admin.users.ban');
            Route::post('/{user}/unban', [UsersController::class, 'unban'])->name('admin.users.unban');
            Route::post('/{user}/make-moderator', [UsersController::class, 'makeModerator'])->name('admin.users.makeModerator');
            Route::post('/{user}/remove-moderator', [UsersController::class, 'removeModerator'])->name('admin.users.removeModerator');
        });
    });

    // Маршруты для админов и модераторов
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

    Route::prefix('modes')->group(function () {
        Route::get('/', [ModesController::class, 'adminIndex'])->name('admin.modes');
        Route::get('/create', [ModesController::class, 'create'])->name('admin.modes.create');
        Route::post('/', [ModesController::class, 'store'])->name('admin.modes.store');
        Route::get('/{id}/edit', [ModesController::class, 'edit'])->name('admin.modes.edit');
        Route::put('/{id}', [ModesController::class, 'update'])->name('admin.modes.update');
        Route::delete('/{id}', [ModesController::class, 'destroy'])->name('admin.modes.destroy');
    });

    Route::prefix('console')->group(function () {
        Route::get('/', [ConsoleController::class, 'index'])->name('admin.console');
        Route::get('/create', [ConsoleController::class, 'create'])->name('admin.console.create');
        Route::post('/', [ConsoleController::class, 'store'])->name('admin.console.store');
        Route::get('/{id}/edit', [ConsoleController::class, 'edit'])->name('admin.console.edit');
        Route::put('/{id}', [ConsoleController::class, 'update'])->name('admin.console.update');
        Route::delete('/{id}', [ConsoleController::class, 'destroy'])->name('admin.console.destroy');
    });

    Route::prefix('characters')->group(function () {
        Route::get('/', [AdminController::class, 'admin'])->name('admin.characters.index');
        Route::get('/{character}/edit', [AdminController::class, 'character'])
            ->name('admin.characters.edit');
        Route::put('/{character}', [CharacterController::class, 'update'])
            ->name('admin.characters.update');
    });
});

require __DIR__.'/auth.php';
