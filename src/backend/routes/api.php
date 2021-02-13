<?php

use App\Http\Controllers\UserController;
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

Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('register', [UserController::class, 'register'])->name('register');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [UserController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'posts', 'as' => 'post.'], function () {
        Route::post('', [PostController::class, 'create'])->name('create');

        Route::group(['prefix' => '{slug}'], function () {
            Route::patch('', [PostController::class, 'update'])->name('update');

            Route::group(['prefix' => 'comments', 'as' => 'comment.'], function () {
                Route::post('', [CommentController::class, 'create'])->name('create');
                Route::patch('{id}', [CommentController::class, 'update'])->name('update');
                Route::delete('{id}', [CommentController::class, 'delete'])->name('delete');
            });
        });
    });
});

Route::group(['prefix' => 'posts', 'as' => 'post.'], function () {
    Route::get('', [PostController::class, 'index'])->name('list');

    Route::group(['prefix' => '{slug}'], function () {
        Route::get('', [PostController::class, 'get'])->name('get');

        Route::group(['prefix' => 'comments', 'as' => 'comment.'], function () {
            Route::get('', [CommentController::class, 'byPostSlug'])->name('get');
        });
    });
});
