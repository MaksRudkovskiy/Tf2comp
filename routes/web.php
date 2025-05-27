<?php


use App\Http\Controllers\{ItemController, BugsController, ArticleController, MainController, ProfileController, ModesController, MistakeController,
ChangesController, BlogController};
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('main_page');
Route::get('/character', [ArticleController::class, 'character'])->name('character');
Route::get('/items', [ItemController::class, 'item'])->name('items');
Route::get('/bugs', [BugsController::class, 'bugs'])->name('bugs_list');
Route::get('/bugs_detail', [BugsController::class, 'bugs_detail'])->name('bugs_detail'); // потом поменять этот маршрут, чтобы он шёл от bugs
Route::get('/modes', [ModesController::class, 'modes'])->name('modes');
Route::get('/changes', [ChangesController::class, 'changes'])->name('changes');
Route::get('/blog', [BlogController::class, 'blog'])->name('blog');
Route::post('/mistakes', [MistakeController::class, 'store'])->name('mistakes.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
