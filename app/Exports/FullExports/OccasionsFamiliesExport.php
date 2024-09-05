<?php

namespace App\Exports\FullExports;

use App\Models\Archive;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class OccasionsFamiliesExport implements FromCollection
{
    public function __construct(public string $occasion) {}

    public function collection(): Collection
    {
        return Archive::all();
    }
}
