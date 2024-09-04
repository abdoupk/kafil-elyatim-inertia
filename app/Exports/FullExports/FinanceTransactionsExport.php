<?php

namespace App\Exports\FullExports;

use App\Models\Finance;
use Maatwebsite\Excel\Concerns\FromCollection;

class FinanceTransactionsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Finance::all();
    }
}
