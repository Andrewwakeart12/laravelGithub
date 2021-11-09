<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('news', function($user,$id){
    return true;
});

Broadcast::channel('notifications-tasks.{id}', function($id){
    return true;
});

Broadcast::channel('messageCenter.{id}', function($id){
    return true;
});

Broadcast::channel('chat.{roomId}', function($user,$roomId){
    $user = Auth::user();
    if($user->canJoinRoom($roomId)){
        return ['id' => $user->id, 'name' => $user->username];
    }
});


Broadcast::channel('groupChat.{roomId}', function($user,$roomId){
    $user = Auth::user();
    return true;
});
