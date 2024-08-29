<?php

namespace App\Http\Controllers\V1\Archive\Exports;

use App\Exports\FamiliesEidAlAdhaIndexExport;
use App\Http\Controllers\Controller;
use App\Models\Archive;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class ExportArchiveFamiliesEidAlAdhaXlsxController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke(Archive $archive)
    {
        return Excel::download(
            new FamiliesEidAlAdhaIndexExport,
            __('exports.archive.eid_al_adha_families', ['date' => $archive->created_at->year]).'.xlsx'
        );
    }
}
