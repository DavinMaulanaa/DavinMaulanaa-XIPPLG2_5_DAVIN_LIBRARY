<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\CategoryController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('loans', LoanController::class);
Route::apiResource('books', BookController::class);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
