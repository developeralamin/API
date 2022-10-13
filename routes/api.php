<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/show', [UserController::class, 'index']);
Route::post('create', [UserController::class, 'create']);

Route::resource('posts', PostController::class)->except(['create', 'edit']);
