<?php

namespace App\Observers;

use App\Models\Database;
use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        Database::where('ip', $user->server)->increment('users', 1);
    }
}
