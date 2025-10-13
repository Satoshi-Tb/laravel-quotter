<?php

use Illuminate\Support\Facades\Route;

// Topページの場合、/quotにリダイレクト
Route::get('/', function () {
    return redirect('/quoot');
});

Route::get('/quoot', App\Http\Controllers\Quoot\IndexController::class);
Route::get('/quoot/create', App\Http\Controllers\Quoot\Create\CreateController::class);
Route::get('/user/{userName}', App\Http\Controllers\User\UserController::class);
Route::get('/user/{userName}/follows', App\Http\Controllers\User\FollowsController::class);
Route::get('/user/{userName}/followers', App\Http\Controllers\User\FollowersController::class);
