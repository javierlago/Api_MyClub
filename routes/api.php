<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;



// Ruta de autenticación
Route::post('/login', [AuthController::class, 'login']);



    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/directivo', [UserController::class, 'index_directivo']);
        Route::get('/entrenador', [UserController::class, 'index_entrenador']);
        Route::get('/atleta', [UserController::class, 'index_atleta']);
        Route::get('/{id}', [UserController::class, 'edit_user_by_id']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::post('/create_user', [UserController::class, 'store']);
    })->middleware('auth:sanctum');


Route :: prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/directivo', [PostController::class, 'indexWithoutExercises']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::post('/create_post', [PostController::class, 'store']);
    Route::post('/create_training', [PostController::class, 'storeWithExercises']);
});
