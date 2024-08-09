<?php

namespace App\Http\Controllers\V1\Occasions\BabyMilkAndDiapers;

use App\Exports\BabiesIndexExport;
use App\Http\Controllers\Controller;
use Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportBabiesXlsxController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke(): BinaryFileResponse
    {
        return Excel::download(new BabiesIndexExport, 'exports.babies-milk-and-diapers.xlsx');
    }
}
