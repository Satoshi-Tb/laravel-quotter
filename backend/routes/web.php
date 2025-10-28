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
Route::get('/quoot/update/{quootId}', App\Http\Controllers\Quoot\Update\UpdateController::class)->middleware('auth');
Route::put('/quoot/update/{quootId}', App\Http\Controllers\Quoot\Update\PutController::class)->middleware('auth');
Route::delete('/quoot/delete/{quootId}', \App\Http\Controllers\Quoot\Delete\DeleteController::class)->middleware('auth')->name('quoot.delete');
Route::get('/user/{userName}', App\Http\Controllers\User\UserController::class)->name('user.index');
Route::post('/user/{userName}/follow', App\Http\Controllers\User\FollowAction\FollowUserController::class)->middleware('auth');
Route::delete('/user/{userName}/follow', App\Http\Controllers\User\FollowAction\UnfollowUserController::class)->middleware('auth');
Route::get('/user/{userName}/follows', App\Http\Controllers\User\FollowsController::class);
Route::get('/user/{userName}/followers', App\Http\Controllers\User\FollowersController::class);
Route::get('/chat/{chatId}', App\Http\Controllers\Chat\ChatController::class)->middleware('auth')->name('chat.index');
Route::post('/chat/{chatId}/messages', App\Http\Controllers\Chat\MessagePostController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
