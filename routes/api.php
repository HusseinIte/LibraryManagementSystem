<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowRecordController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ***************  Auth Routes *********************************
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');

//  ******************* Books Routes *******************************

Route::apiResource('books', BookController::class);

// ****************** Borrowed Routes **************************
Route::middleware('auth:api')->group(function () {
    Route::post('books/{id}/borrow', [BorrowRecordController::class, 'borrowBook'])->middleware('Admin');
    Route::post('borrowRecords/{id}/return', [BorrowRecordController::class, 'returnBook']);
});
// **************   Rating Routes ********************************


//*****************  category Routes ***************************
Route::apiResource('categories', CategoryController::class)->middleware(['auth:api', 'Admin']);
