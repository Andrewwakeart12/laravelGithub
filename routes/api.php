<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\api\ApiPostController;
use App\Http\Controllers\api\RolesApiController;
use App\Http\Controllers\api\EventApiController;
use App\Http\Controllers\api\UsersApiController;
use App\Http\Controllers\api\ApiTaskController;

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
    Route::resource('/roles', RolesApiController::class);

});

Route::get('/options', [UsersApiController::class, 'options'])->name('options');
Route::get('/eventos', [EventApiController::class, 'calendarEvents'])->name('events');

Route::resource('/task', ApiTaskController::class);
