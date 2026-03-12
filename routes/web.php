<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});


Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);
Route::middleware('checkauth')->group(function () {

    Route::get('/posts', [PostController::class, 'index']);

    Route::post('/post', [PostController::class, 'store']);

    Route::delete('/post/{post}', [PostController::class, 'destroy']);
    Route::get('/post/{id}/edit', [PostController::class, 'edit']);
    Route::put('/post/{id}', [PostController::class, 'update']); // <-- ici PUT

    Route::post('/like/{id}', [LikeController::class, 'like'])->middleware('checkauth');
});