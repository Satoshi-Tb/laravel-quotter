<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Topページの場合、/quotにリダイレクト
Route::get('/', function () {
    return redirect('/quoot');
});

Route::get('/quoot', App\Http\Controllers\Quoot\IndexController::class)->name('quoot.index');
Route::get('/quoot/create', App\Http\Controllers\Quoot\Create\CreateController::class)->middleware('auth');
Route::post('/quoot/create', App\Http\Controllers\Quoot\Create\PostController::class)->middleware('auth');
Route::get('/user/{userName}', App\Http\Controllers\User\UserController::class);
Route::get('/user/{userName}/follows', App\Http\Controllers\User\FollowsController::class);
Route::get('/user/{userName}/followers', App\Http\Controllers\User\FollowersController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
