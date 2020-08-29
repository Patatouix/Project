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

Broadcast::channel('notification.admin', function ($user) {
    return (int) $user->admin == 1;
});

Broadcast::channel('notification.user.{id}', function ($user, $id) {
    return (int) $user->id == (int) $id;
});

Broadcast::channel('chat', function ($user) {
    return ['id' => $user->id, 'admin' => $user->admin, 'name' => $user->name, 'prenom' => $user->prenom];
});
