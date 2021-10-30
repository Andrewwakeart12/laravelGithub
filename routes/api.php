<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\api\ApiPostController;
use App\Http\Controllers\api\RolesApiController;
use App\Http\Controllers\api\EventApiController;
use App\Http\Controllers\api\UsersApiController;
use App\Http\Controllers\api\ApiTaskController;
use App\Http\Controllers\api\ChatApiController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>['auth:api']], function(){
    Route::resource('/Posts', ApiPostController::class);
    Route::resource('/users', UsersApiController::class);
    Route::get('/getRoles', [UsersApiController::class, 'getRoles'] )->name('getRoles');
    Route::get('/getUsers', [UsersApiController::class, 'getUsersInfo'] )->name('getUsers');
    Route::get('/getNotifications', [UsersApiController::class, 'getChatNotifications'] )->name('getChatNotifications');
    Route::get('/getChatNotifications', [UsersApiController::class, 'getNotifications'] )->name('getNotifications');
    Route::get('/readMessagesNotifications/{notification_id}', [UsersApiController::class, 'readNotifications'] )->name('readNotifications');
    Route::get('/readNotifications/{notification_id}', [UsersApiController::class, 'readMessagesNotifications'] )->name('readMessagesNotifications');
    Route::get('/getLastNotification', [UsersApiController::class, 'getLastNotification'] )->name('getLastNotification');
    Route::get('/getThisUserId', [UsersApiController::class, 'getThisUserId'] )->name('thisUserId');
    Route::get('/getUsersChats', [ChatApiController::class, 'getUsersChats'] )->name('getUsersChats');
    Route::get('/preselectedSecondUser', [ChatApiController::class, 'preselectedSecondUser'] )->name('preselectedSecondUser');
    Route::post('/getMessagesInChat', [ChatApiController::class, 'getMessagesInChat'] )->name('getMessagesInChat');
    Route::post('/sendMessage', [ChatApiController::class, 'sendMessage'] )->name('sendMessage');
    Route::get('/getChannels', [ChatApiController::class, 'getChannels'] )->name('getChannels');
    Route::resource('/roles', RolesApiController::class);
    Route::resource('/task', ApiTaskController::class);
});
Route::get('/eventos', [EventApiController::class, 'calendarEvents'])->name('events');


