<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\ArticlesList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ArticlesList::class)->name('home');

Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles/{slug}', 'show')->name('article.show');
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::post('/articles', 'create')->name('article.create');
    Route::delete('/articles/{id}', 'destroy')->name('article.destroy');
    Route::get('/articles/edit/{slug}', 'editArticle')->name('article.edit');
    Route::put('/articles/{id}', 'update')->name('article.update');
    Route::get('/tags/{tag}', 'detail_tag')->name('tags');
});
Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login_form')->name('login.form');
    Route::post('/login', 'login')->name('login.action');
    Route::get('/register', 'register_form')->name('register.form');
    Route::post('/register', 'register')->name('register.action');
    Route::delete('/logout', 'logout')->name('logout.action');
    Route::get('/profile/{user}', 'profile')->name('profile');
});
Route::controller(CommentController::class)->group(function () {
    Route::post('/comments/{slug}', 'inputComment')->name('comment.create');
    Route::delete('/comments/{id}', 'deleteComment')->name('comment.destroy');
});
