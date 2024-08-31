<?php

namespace App\Console\Commands;

use App\Models\Family;
use Illuminate\Console\Command;

class CalculateFamiliesIncomeRateCommand extends Command
{
    protected $signature = 'calculate:families-income-rate';

    protected $description = 'Calculate families income rate';

    public function handle(): void
    {
        Family::chunk(1000, fn (Family $family) => $family->update(['income_rate' => calculateIncomeRate($family)]));
    }
}
