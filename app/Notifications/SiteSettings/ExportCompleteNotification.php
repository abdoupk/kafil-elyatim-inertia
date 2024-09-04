<?php

namespace App\Notifications\SiteSettings;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ExportCompleteNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $zipFilePath,
        public User $user) {}

    public function via($notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([]);
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
