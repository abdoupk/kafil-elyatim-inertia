<?php

namespace App\Http\Controllers\V1\Occasions\EidAlAdha;

use App\Exports\FamiliesEidAlAdhaIndexExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportFamiliesEidAlAdhaXlsxController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke(): BinaryFileResponse
    {
        return Excel::download(new FamiliesEidAlAdhaIndexExport, __('exports.eid_al_adha_families', ['date' => now()->year]).'.xlsx');
    }
}
