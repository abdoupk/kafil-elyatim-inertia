<?php

namespace App\Http\Controllers\V1\Occasions\RamadanBasket;

use App\Exports\FamiliesEidAlAdhaIndexExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportFamiliesRamadanBasketXlsxController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke(): BinaryFileResponse
    {
        return Excel::download(new FamiliesEidAlAdhaIndexExport, 'exports.ramadan_basket_'.now()->year.'.xlsx');
    }
}
