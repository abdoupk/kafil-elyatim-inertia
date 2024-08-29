<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Browsershot\Exceptions\CouldNotTakeBrowsershot;
use Throwable;

class ExportFinancialTransactionsPDFController extends Controller implements HasMiddleware
{
    /**
     * @throws Throwable
     * @throws CouldNotTakeBrowsershot
     */
    public function __invoke()
    {
        return saveToPDF('financial-transactions', 'transactions', fn () => getFinancesForExport());
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
