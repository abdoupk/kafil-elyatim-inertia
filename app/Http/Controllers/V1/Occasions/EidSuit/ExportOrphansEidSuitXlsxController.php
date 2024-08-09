<?php

namespace App\Http\Controllers\V1\Occasions\EidSuit;

use App\Exports\FamiliesEidAlAdhaIndexExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportOrphansEidSuitXlsxController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke(): BinaryFileResponse
    {
        return Excel::download(new FamiliesEidAlAdhaIndexExport, 'exports.eid_al_adha_families_'.now()->year.'.xlsx');
    }
}
