<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('rbzgo-chat.{sender_id}.{receiver_id}', function ($user, $sender_id, $receiver_id) {
    return $user->id == $receiver_id;
});

Broadcast::channel('online', function ($user) {
    if (auth()->check()) {
        return $user;
    }
});

Broadcast::channel('group-request.{user_id}', function ($user, $user_id) {
    return true;
});
