<?php

namespace App\Jobs\V1\Branch;

use App\Models\Branch;
use App\Models\User;
use App\Notifications\Branch\UpdateBranchNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class BranchUpdatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Branch $branch, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->branches_and_zones_changes', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new UpdateBranchNotification(branch: $this->branch, user: $this->user));
    }
}
