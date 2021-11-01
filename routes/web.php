<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Broadcast;
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
        $api_token = Auth::user()->api_token;
        $thisUserId = Auth::user()->id;
        return view('admin.index',compact(['api_token','thisUserId']));
    })->name('adminPage');
    Route::get('/admin/{any}',function(){
        $api_token = Auth::user()->api_token;
        $thisUserId = Auth::user()->id;
        return view('admin.index',compact(['api_token','thisUserId']));
    })->where('any', '.*');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/getApiKey', [PostController::class, 'getApiKey'])->name('getApiKey');
Route::get('/test',function(){
   event(new \App\Events\News('message'));
   $notifications = Auth::user()->notifications;
   dd("$notifications");
});
Route::get('/chatOptions', function () {
    return view('admin.chatOptions');
});
Broadcast::routes();
