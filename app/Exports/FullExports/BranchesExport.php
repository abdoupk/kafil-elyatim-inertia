<?php

namespace App\Exports\FullExports;

use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;

class BranchesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Branch::all();
    }
}
