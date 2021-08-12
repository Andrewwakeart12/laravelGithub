<?php

use Illuminate\Support\Facades\Mail;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sendEmail', function () {
   $data = ['title'=>'hello there :D',
   'body'=>'what ever goes in the content it really doesnt matter'
];
   Mail::to('andrewwake.art@gmail.com')->send(new \App\Mail\MyTestEmail($data));
});

Route::get('/post/{id}', 'App\Http\Controllers\AdminPostsController@post');

Route::group(['middleware'=>'admin'], function(){

    Route::get('/admin', function(){
        return redirect(route('users.index'));
    });
    Route::resource('/admin/users',  "App\Http\Controllers\AdminUsersController");

    Route::resource('/admin/posts',  "App\Http\Controllers\AdminPostsController");
    Route::resource('/admin/categories',  "App\Http\Controllers\AdminCategoriesController");

    Route::resource('/admin/media',  "App\Http\Controllers\AdminMediasController");
    Route::resource('/admin/comments',  "App\Http\Controllers\PostsCommentsController");
    Route::resource('/admin/comments/replies',  "App\Http\Controllers\CommentsRepliesController");
});


