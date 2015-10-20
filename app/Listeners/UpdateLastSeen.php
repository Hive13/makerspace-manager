<?php

namespace App\Listeners;

use App\Events\PermissionChecked;
use Carbon\Carbon;

class UpdateLastSeen
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PermissionChecked $event
     * @return void
     */
    public function handle(PermissionChecked $event)
    {
        $user = $event->user;
        $user->last_seen = Carbon::now();
        $user->save();
    }
}
