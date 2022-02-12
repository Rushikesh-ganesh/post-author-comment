<?php

use Illuminate\Support\Facades\Route;
use App\Models\PostModel;
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

Route::get('/', function () {
    $posts = PostModel::with('Author')->paginate(2);
    return view('home',compact('posts'));
});

Route::get('/checkauth', function () {
    return (\Auth::check()) ? True : False;
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create_post', [App\Http\Controllers\PostController::class, 'create'])->name('create_post');
Route::post('/store_post', [App\Http\Controllers\PostController::class, 'store'])->name('post_submit');
Route::get('/edit_post/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('edit_post');
Route::put('/update_post/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('update_post');
Route::delete('/delete_post/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('delete_post');

