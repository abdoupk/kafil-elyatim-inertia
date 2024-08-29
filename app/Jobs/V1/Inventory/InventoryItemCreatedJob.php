<?php

namespace App\Jobs\V1\Inventory;

use App\Models\Inventory;
use App\Models\User;
use App\Notifications\Inventory\CreateInventoryItemNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class InventoryItemCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Inventory $item, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->association_changes', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new CreateInventoryItemNotification(item: $this->item, user: $this->user)
        );
    }
}
