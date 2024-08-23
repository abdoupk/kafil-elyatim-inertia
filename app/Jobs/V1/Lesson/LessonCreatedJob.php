<?php

namespace App\Jobs\V1\Lesson;

use App\Models\Event;
use App\Models\User;
use App\Notifications\Lesson\CreateLessonNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class LessonCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Event $event, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->schools_and_lessons_changes', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new CreateLessonNotification(event: $this->event, user: $this->user));
    }
}
