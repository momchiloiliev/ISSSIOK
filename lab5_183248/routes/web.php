<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/home');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Add this route to handle new post creation
Route::post('/home', [PostController::class, 'store'])->name('posts.store');

Route::get('/newpost', [PostController::class, 'create'])->name('newpost');

Route::post('/post/{slug}/comment', [CommentController::class, 'store'])->name('comment.store');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
