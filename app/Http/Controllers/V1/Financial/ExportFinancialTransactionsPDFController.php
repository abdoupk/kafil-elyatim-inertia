<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Throwable;

class ExportFinancialTransactionsPDFController extends Controller
{
    /**
     * @throws Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function __invoke()
    {
        return saveToPDF('financial-transactions', 'transactions', fn () => getFinancesForExport());
    }
}
