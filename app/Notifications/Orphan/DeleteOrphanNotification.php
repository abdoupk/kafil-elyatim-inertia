<?php

namespace App\Notifications\Orphan;

use App\Models\Orphan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class DeleteOrphanNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Orphan $orphan, public User $user) {}

    public function via(): array
    {
        return ['database', 'broadcast'];
    }

    public function toArray(): array
    {
        return [
            'data' => [
                'name' => $this->orphan->getName(),
                'zone' => $this->orphan->family->zone->name,
                'branch' => $this->orphan->family->branch->name,
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->getName(),
                'gender' => $this->user->gender,
            ],
            'metadata' => [
                'deleted_at' => $this->orphan->deleted_at,
                'url' => route('tenant.orphans.show', $this->orphan->id),
            ],
        ];
    }

    public function toBroadcast(): BroadcastMessage
    {
        return new BroadcastMessage([
            'data' => [
                'name' => $this->orphan->getName(),
                'zone' => $this->orphan->family->zone->name,
                'branch' => $this->orphan->family->branch->name,
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->getName(),
                'gender' => $this->user->gender,
            ],
            'metadata' => [
                'deleted_at' => $this->orphan->deleted_at,
                'url' => route('tenant.orphans.show', $this->orphan->id),
            ],
        ]);
    }

    public function databaseType(): string
    {
        return 'orphan.deleted';
    }
}
