<?php

namespace App\Notifications;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class CreateBranchNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Branch $branch, public User $user) {}

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable): array
    {
        return [
            'notification' => $this->makeNotificationMessage($notifiable),
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->getName(),
                'gender' => $this->user->gender,
            ],
        ];
    }

    private function makeNotificationMessage(User $notifiable): string
    {
        // TODO: add locale of user from settings in ths moment set default ar in function
        return trans_choice('notifications.branch.created', $this->user->gender === 'male' ? 1 : 0, [
            'name' => $this->branch->name,
            'city' => $this->branch->city->getFullName(),
        ]);
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'notification' => $this->makeNotificationMessage($notifiable),
        ]);
    }
}
