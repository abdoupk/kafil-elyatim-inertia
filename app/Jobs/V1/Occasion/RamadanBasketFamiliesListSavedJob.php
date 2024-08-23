<?php

namespace App\Jobs\V1\Occasion;

use App\Models\Branch;
use App\Models\User;
use App\Notifications\Branch\CreateBranchNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class RamadanBasketFamiliesListSavedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Branch $branch, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->occasions_saves', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new CreateBranchNotification(branch: $this->branch, user: $this->user));
    }
}
