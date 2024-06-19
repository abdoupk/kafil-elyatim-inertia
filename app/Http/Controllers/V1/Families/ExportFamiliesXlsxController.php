<?php

namespace App\Http\Controllers\V1\Families;

use App\Exports\FamiliesIndexExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportFamiliesXlsxController extends Controller
{
    public function __invoke(): BinaryFileResponse
    {
        return Excel::download(new FamiliesIndexExport, 'families.xlsx');
    }
}
