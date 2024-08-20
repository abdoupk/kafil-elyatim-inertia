<?php

namespace App\Jobs\V1\Inventory;

use App\Models\Inventory;
use App\Models\User;
use App\Notifications\Inventory\DeleteInventoryItemNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;

class InventoryItemUpdatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Inventory $item, public User $user) {}

    public function handle(): void
    {
        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->branches_and_zones_changes', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new DeleteInventoryItemNotification(item: $this->item, user: $this->user));
    }
}
