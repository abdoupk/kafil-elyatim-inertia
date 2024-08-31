<?php

namespace App\Console\Commands;

use App\Models\Baby;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class UnSearchOrphansOlderThanTwoYearsCommand extends Command
{
    protected $signature = 'unSearch:orphans-older-than-two-years';

    protected $description = 'Delete and unSearch orphans older than two years';

    public function handle(): void
    {
        Baby::with('orphan')->where('orphan.birth_date', '>', now()->subYears(2))->chunk(1000, function (Collection $babies) {
            $babies->each(function (Baby $baby) {
                $baby->unsearchable();

                $baby->forceDelete();
            });
        });
    }
}
