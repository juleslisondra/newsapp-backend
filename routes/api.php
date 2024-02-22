<?php

use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('bookmarks', BookmarksController::class);

    Route::prefix('news')->group(function () {
        Route::post('/search', [NewsController::class, 'search'])
                ->name('search');
    });

    Route::get('/bookmarks/user/{user}', [BookmarksController::class, 'bookmarks'])->name('user_bookmarks');
});
