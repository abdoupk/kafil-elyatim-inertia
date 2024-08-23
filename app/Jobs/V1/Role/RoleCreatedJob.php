<?php

namespace App\Jobs\V1\Role;

use App\Models\Role;
use App\Models\User;
use App\Notifications\Role\CreateRoleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class RoleCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Role $role, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->association_changes', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new CreateRoleNotification(role: $this->role, user: $this->user));
    }
}
