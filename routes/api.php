<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Routes untuk MenuController
    Route::get('/menus', [MenuController::class, 'index']);
    Route::get('/menus/{id}', [MenuController::class, 'show']);
    Route::post('/menus', [MenuController::class, 'store']);
    Route::put('/menus/{id}', [MenuController::class, 'update']);
    Route::delete('/menus/{id}', [MenuController::class, 'destroy']);

    // Routes untuk CategoryController
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
});