<?php

namespace App\Jobs\V1\School;

use App\Models\PrivateSchool;
use App\Models\User;
use App\Notifications\School\CreateSchoolNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class SchoolCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public PrivateSchool $school, public User $user)
    {
    }

    public function handle(): void
    {
        Notification::send(
            getUsersShouldBeNotified(
                permissions: ['list_schools', 'view_schools'],
                userToExclude: $this->user,
                notificationType: 'schools_and_lessons_changes'
            ),
            new CreateSchoolNotification(
                school: $this->school,
                user: $this->user
            )
        );
    }
}
