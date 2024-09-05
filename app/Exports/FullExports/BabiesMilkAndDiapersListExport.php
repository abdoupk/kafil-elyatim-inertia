<?php

namespace App\Exports\FullExports;

use App\Models\Archive;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class BabiesMilkAndDiapersListExport implements FromCollection
{
    public function collection(): Collection
    {
        return Archive::all();
    }
}
