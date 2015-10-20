<?php

namespace App\Listeners;

use App\Events\PermissionChecked;
use App\Models\Activity;

class LogActivity
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
        $activity = new Activity();
        $activity->activity_type = get_class($event->permission);
        $activity->activity_id = $event->permission->id;
        $activity->user_id = $event->user->id;
        $activity->save();
    }
}
