<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
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

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'posts', 'as' => 'post.'], function () {
    Route::get('', [PostController::class, 'index'])->name('list');

    Route::group(['prefix' => '{slug}'], function () {
        Route::get('', [PostController::class, 'get'])->name('get');
        Route::get('comments', [CommentController::class, 'byPostSlug'])->name('comments');
    });
});
