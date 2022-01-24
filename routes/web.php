<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Page;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');
// Route::get('/', function() {
//     $page = Page::with('comments')->first();
//     $comment = Comment::all();
//     dd($comment->child_comments);
// })->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::get('/comment/{id}', [CommentController::class, 'getChilde'])->name('comment.childes');
Route::get('/show/{id}', [HomeController::class, 'show_page'])->name('show_page');
Route::resource('page',PageController::class);
Route::resource('category',CategoryController::class);
