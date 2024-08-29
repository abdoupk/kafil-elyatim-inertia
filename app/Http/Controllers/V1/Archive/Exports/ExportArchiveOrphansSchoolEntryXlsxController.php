<?php

namespace App\Http\Controllers\V1\Archive\Exports;

use App\Exports\OrphansSchoolEntryIndexExport;
use App\Http\Controllers\Controller;
use App\Models\Archive;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;

class ExportArchiveOrphansSchoolEntryXlsxController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function __invoke(Archive $archive)
    {
        return Excel::download(
            new OrphansSchoolEntryIndexExport,
            __('exports.archive.school_entry', ['date' => $archive->created_at->year]).'.xlsx'
        );
    }
}
