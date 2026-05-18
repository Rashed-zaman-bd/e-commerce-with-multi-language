<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageMenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;



// user routes
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'index']);
Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);


// brands routes
Route::get('/brand', [BrandController::class, 'index']);
Route::get('/brand/{id}', [BrandController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/brand', [BrandController::class, 'store']);
    Route::post('/brand/{id}', [BrandController::class, 'update']);
    Route::delete('/brand/{id}', [BrandController::class, 'destroy']);
});


// category routes
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::middleware('auth:Sanctum')->group(function () {
    Route::post('/category', [CategoryController::class, 'store']);
    Route::post('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
});



// product routes
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/product', [ProductController::class, 'store']);
    Route::post('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

});


Route::get('/image-menu', [ImageMenuController::class, 'index']);
Route::get('/image-menu/{id}', [ImageMenuController::class, 'show']);
Route::post('/image-menu', [ImageMenuController::class, 'store']);
Route::post('/image-menu/{id}', [ImageMenuController::class, 'update']);
Route::delete('/image-menu/{id}', [ImageMenuController::class, 'destroy']);
