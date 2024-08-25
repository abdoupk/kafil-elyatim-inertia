<?php

namespace App\Http\Controllers\V1\Archive\Exports;

use App\Exports\FamiliesMonthlyBasketIndexExport;
use App\Http\Controllers\Controller;
use App\Models\Archive;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class ExportArchiveFamiliesMonthlyBasketXlsxController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke(Archive $archive)
    {
        return Excel::download(new FamiliesMonthlyBasketIndexExport,
            __('exports.archive.monthly_basket_families', ['date' => $archive->created_at->translatedFormat('F Y')]).'.xlsx');
    }
}
