<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return "about";
});

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});


Route::post('/login', [AuthController::class, 'login']);

/*Route::get ('/user_index',[UserController::class,'index']);

Route::get ('/user_index_directivo',[UserController::class,'index_directivo']);

Route::get ('/user_index_entrenador',[UserController::class,'index_entrenador']);

Route::get ('/user_index_atleta',[UserController::class,'index_atleta']);

Route::get('/user_get_by_id/{id}',[UserController::class,'get_user_by_id']);


Route::delete('/user_delete/{id}', [UserController::class, 'destroy']);


Route::put('/user_update/{id}',[UserController::class,'update']);


// Cuidado al escribir las rutas y los parametros en postman se pasan literal

Route::post('/user_create',[UserController::class,'store']);*/


Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/directivo', [UserController::class, 'index_directivo']);
    Route::get('/entrenador', [UserController::class, 'index_entrenador']);
    Route::get('/atleta', [UserController::class, 'index_atleta']);
    Route::get('/{id}', [UserController::class, 'edit_user_by_id']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::post('/create_user', [UserController::class, 'store']);
});