<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Redis;
use App\Models\User;
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
Route::group(['middleware'=>'auth'],function(){

    Route::get('/', function () {
        return view('welcome');
    });
});
Route::Get('/mucks', function(){

});
Route::group(['middleware'=>'admin'],function(){



    Route::get('/admin/', function () {
        $api_token= Auth::user()->api_token;
        return view('admin.index',compact('api_token'));
    })->name('adminPage');

});
/*
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

Route::group(['middleware'=>'auth'],function(){
    Route::resource('/comments/reply',  "App\Http\Controllers\CommentsRepliesController");
});
*/

/**/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/getApiKey', [PostController::class, 'getApiKey'])->name('getApiKey');
Route::get('/test',function(){
   event(new \App\Events\News('message'));
   $notifications = Auth::user()->notifications;
   dd("$notifications");
});
Route::get('/chat/{id}', [ChatController::class, 'chat'])->name('chat');
Route::get('/group/chat/{id}',[ChatController::class, 'groupChat'])->name('group.chat');
Route::post('/chat/message/send',[ChatController::class, 'send'])->name('chat.send');
Route::post('/chat/message/send/file', [ChatController::class, 'sendFilesInConversation'])->name('chat.send.file');
Route::post('/group/chat/message/send', [ChatController::class, 'groupSend'])->name('group.send');
Route::post('/group/chat/message/send/file',[ChatController::class, 'sendFilesInGroupConversation'])->name('group.send.file');
Route::get('/home', 'HomeController@index')->name('home');

Broadcast::routes();
