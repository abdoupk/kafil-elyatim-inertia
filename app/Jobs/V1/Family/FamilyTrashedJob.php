<?php

namespace App\Jobs\V1\Family;

use App\Models\Family;
use App\Models\User;
use App\Notifications\Family\DeleteFamilyNotification;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Notification;
use Throwable;

class FamilyTrashedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Family $family, public User $user) {}

    /**
     * @throws Throwable
     */
    public function handle(): void
    {
        $this->handleDelete();

        Notification::send(
            User::whereHas('settings', function ($query) {
                return $query->where('notifications->families_changes', true);
            })->where('users.id', '!=', $this->user->id)->get(),
            new DeleteFamilyNotification(family: $this->family, user: $this->user));
    }

    /**
     * @throws Throwable
     */
    private function handleDelete(): void
    {
        DB::transaction(function () {
            $this->unSearch();

            $this->deleteRelationships();
        });
    }

    private function unSearch(): void
    {
        $this->family->orphansSponsorships->unsearchable();

        $this->family->sponsorSponsorships->unsearchable();

        $this->family->orphans->unsearchable();

        $this->family->babies->unsearchable();

        $this->family->orphansNeeds->unsearchable();

        $this->family->sponsorsNeeds->unsearchable();

        $this->family->sponsor->unsearchable();
    }

    private function deleteRelationships(): void
    {
        $this->family->babies()->delete();

        $this->family->sponsor()->update([
            'deleted_at' => now(),
            'deleted_by' => $this->user->id,
        ]);

        $this->family->orphans()->update([
            'deleted_at' => now(),
            'deleted_by' => $this->user->id,
        ]);

        DB::table('needs')->where('needable_id', $this->family->sponsor->id)
            ->orWhereIn('needable_id', $this->family->orphans->pluck('id'))
            ->update(['deleted_at' => now(), 'deleted_by' => $this->user->id]);
    }
}
