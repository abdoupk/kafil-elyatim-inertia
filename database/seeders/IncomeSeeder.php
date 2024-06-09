<?php

namespace Database\Seeders;

use App\Models\Income;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    public function run(): void
    {
        $incomes = ['cnr', 'cnas', 'casnos', 'pension', 'account', 'other_income'];

        Income::insert(array_map(static function ($income) {
            return [
                'id' => fake()->uuid,
                'name' => $income,
            ];
        }, $incomes));
    }
}
