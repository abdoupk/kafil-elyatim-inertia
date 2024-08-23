<?php

namespace App\Jobs\V1\Orphan;

use App\Models\Orphan;
use App\Models\User;
use App\Notifications\Orphan\DeleteOrphanNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class OrphanTrashedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Orphan $orphan, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->families_changes', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new DeleteOrphanNotification(orphan: $this->orphan, user: $this->user));
    }
}
