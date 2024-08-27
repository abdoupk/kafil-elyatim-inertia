<?php

namespace App\Jobs\V1\Family;

use App\Models\Family;
use App\Models\User;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FamilyRestoredJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Family $family, public User $user) {}

    public function handle(): void
    {
        $this->restore();

        $this->makeSearchable();
    }

    private function restore(): void
    {
        $sponsor = $this->family->sponsor()->withTrashed()->first();

        $orphans = $this->family->orphans()->withTrashed();

        $orphans->restore();

        $sponsor->restore();

        $this->family->babies()->withTrashed()->restore();

        DB::table('needs')->where('needable_id', $sponsor->id)
            ->orWhereIn('needable_id', $orphans->pluck('id'))
            ->update(['deleted_at' => null, 'deleted_by' => null]);
    }

    private function makeSearchable(): void
    {
        $this->family->sponsorships->searchable();

        $this->family->orphansSponsorships->searchable();

        $this->family->sponsorSponsorships->searchable();

        $this->family->orphansNeeds->searchable();

        $this->family->sponsorsNeeds->searchable();

        $this->family->sponsor()->searchable();

        $this->family->orphans->searchable();

        $this->family->babies->searchable();
    }
}
