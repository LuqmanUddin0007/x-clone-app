<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PostController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile/update', [ProfileController::class, 'updateProfile']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::get('/users/posts', [PostController::class, 'getUserPosts']);
});

Route::get('/users/{id}/profile', [ProfileController::class, 'publicProfile']);
Route::get('/users/{id}/posts', [PostController::class, 'getUserPostsPublic']);