<?php

namespace Database\Seeders;

use App\Models\Income;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class IncomeSponsorSeeder extends Seeder
{
    public function run(): void
    {

        Sponsor::select(['id', 'tenant_id'])->each(static function (Sponsor $sponsor) {
            $ids = Income::inRandomOrder()->take(random_int(1, 2))->get()->pluck('id');
            $sponsor->incomes()->attach($ids, [
                'value' => random_int(10000, 52220),
                'tenant_id' => $sponsor->tenant_id,
            ]);
        });
    }
}
