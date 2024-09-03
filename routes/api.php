<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowRecordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RatingController;
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
    Route::post('books/{id}/borrow', [BorrowRecordController::class, 'borrowBook']);
    Route::post('borrowRecords/{id}/return', [BorrowRecordController::class, 'returnBook']);
    Route::get('borrowedRecords/myBorrowedBook', [BorrowRecordController::class, 'showMyBorrowedBook']);
});
// **************   Rating Routes ********************************


//*****************  category Routes ***************************
Route::apiResource('categories', CategoryController::class)->middleware(['auth:api', 'Admin']);


// ******* Rating Route with Authentication  **********
Route::middleware('auth:api')->group(function () {
    Route::get('ratings/myRatings', [RatingController::class, 'showMyRating']);
    Route::post('ratings', [RatingController::class, 'store']);
    Route::put('ratings/{rating}', [RatingController::class, 'update']);
    Route::delete('ratings/{rating}', [RatingController::class, 'destroy']);
});
