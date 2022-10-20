<?php

use App\Http\Controllers\API\ArticleAPIController;
use App\Http\Controllers\API\AuthController;
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

// Route::apiResource('/article', [ArticleController::class]);
Route::controller(ArticleAPIController::class)->group(function () {
    Route::get('/articles', 'index')->name('articles');
    Route::get('/articles/{id}', 'show')->name('articles.detail');
    Route::get('/articles/tag/cari/{tag}', 'search_tag')->name('search.tag.articles');
    Route::get('/articles/title/cari/{title}', 'search_title')->name('search.title.articles');;
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('user.register');
    Route::post('/login', 'login')->name('user.login');
});

Route::middleware('auth:sanctum')->controller(ArticleAPIController::class)->group(function () {
    Route::post('/articles', 'store')->name('created.article');
    Route::put('/articles/{id}', 'update')->name('article.updated');
    Route::delete('/articles/{id}', 'destroy')->name('articles.deleted');
});
Route::middleware('auth:sanctum')->controller(AuthController::class)->group(function () {
    Route::get('/logout', 'logout')->name('user.logout');
});
