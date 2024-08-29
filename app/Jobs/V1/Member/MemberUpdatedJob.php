<?php

namespace App\Jobs\V1\Member;

use App\Models\User;
use App\Notifications\Member\UpdateMemberNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class MemberUpdatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public User $member, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->association_changes', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new UpdateMemberNotification(member: $this->member, user: $this->user)
        );
    }
}
