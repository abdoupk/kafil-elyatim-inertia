<?php

namespace App\Http\Controllers\V1\Families;

use App\Exports\FamiliesIndexExport;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportFamiliesXlsxController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return ['can:export_families'];
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke(): BinaryFileResponse
    {
        return Excel::download(new FamiliesIndexExport, __('exports.families').'.xlsx');
    }
}
