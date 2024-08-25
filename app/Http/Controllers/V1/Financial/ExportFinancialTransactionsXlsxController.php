<?php

namespace App\Http\Controllers\V1\Financial;

use App\Exports\FinancesIndexExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class ExportFinancialTransactionsXlsxController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke()
    {
        return Excel::download(new FinancesIndexExport, __('exports.transactions').'.xlsx');
    }
}
