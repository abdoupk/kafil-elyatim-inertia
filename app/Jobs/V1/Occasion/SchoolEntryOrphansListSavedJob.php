<?php

namespace App\Jobs\V1\Occasion;

use App\Models\Archive;
use App\Models\User;
use App\Notifications\Occasion\SaveSchoolEntryOrphansListNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class SchoolEntryOrphansListSavedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Archive $archive, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->occasions_saves', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new SaveSchoolEntryOrphansListNotification(archive: $this->archive, user: $this->user));
    }
}
