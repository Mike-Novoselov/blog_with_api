<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Api\UserController;

use \App\Http\Controllers\Api\FileController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


//Route::get('/user', [UserController::class, 'index']); // из класса UserController вызываем метод index

Route::apiResources([
    'user' => UserController::class,
]);

Route::post('upload', [FileController::class, 'upload']);
Route::post('user/{user}/avatar', [UserController::class, 'updateAvatar']); //маршрут для обновления аватарки
