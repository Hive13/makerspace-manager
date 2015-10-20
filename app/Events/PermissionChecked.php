<?php

namespace App\Events;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class PermissionChecked extends Event
{
    use SerializesModels;

    public $permission;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Permission $permission, User $user)
    {
        $this->permission = $permission;
        $this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
