<?php

use Illuminate\Support\Facades\Broadcast;

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
Broadcast::channel('notifications-tasks.{id}', function($id){
    return true;
});
Broadcast::channel(
    $this->app['config']->get('laravel-video-chat.channel.chat_room').'-{conversationId}',
    function ($user, $conversationId) {
        if ($this->app['conversation.repository']->canJoinConversation($user, $conversationId)) {
            return $user;
        }
    }
);

Broadcast::channel(
    $this->app['config']->get('laravel-video-chat.channel.group_chat_room').'-{groupConversationId}',
    function ($user, $groupConversationId) {
        if ($this->app['group.conversation.repository']->canJoinGroupConversation($user, $groupConversationId)) {
            return $user;
        }
    }
);
