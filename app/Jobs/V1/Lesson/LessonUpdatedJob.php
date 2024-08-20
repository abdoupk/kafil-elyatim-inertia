<?php

namespace App\Jobs\V1\Lesson;

use App\Models\Lesson;
use App\Models\User;
use App\Notifications\Lesson\UpdateLessonNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class LessonUpdatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Lesson $lesson, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->branches_and_zones_changes', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new UpdateLessonNotification(lesson
                : $this->lesson, user: $this->user));
    }
}
