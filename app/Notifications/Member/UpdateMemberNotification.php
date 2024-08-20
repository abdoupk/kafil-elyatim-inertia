<?php

namespace App\Notifications\Member;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class UpdateMemberNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public User $member, public User $user) {}

    public function via(): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(): array
    {
        return [
            'data' => [
                'name' => $this->branch->name,
                'city' => $this->branch->city->getFullName(),
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->getName(),
                'gender' => $this->user->gender,
            ],
            'metadata' => [
                'created_at' => $this->branch->created_at,
                'url' => route('tenant.branches.show', $this->branch->id),
            ],
        ];
    }

    public function toBroadcast(): BroadcastMessage
    {
        return new BroadcastMessage([
            'data' => [
                'name' => $this->branch->name,
                'city' => $this->branch->city->getFullName(),
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->getName(),
                'gender' => $this->user->gender,
            ],
            'metadata' => [
                'created_at' => $this->branch->created_at,
                'url' => route('tenant.branches.index').'?show='.$this->branch->id,
            ],
        ]);
    }

    public function databaseType(): string
    {
        return 'branch.created';
    }
}
