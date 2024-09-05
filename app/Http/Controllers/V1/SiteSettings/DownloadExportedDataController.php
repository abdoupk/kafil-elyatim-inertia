<?php

namespace App\Http\Controllers\V1\SiteSettings;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadExportedDataController extends Controller
{
    public function __invoke(): BinaryFileResponse
    {
        return response()->download(storage_path(tenant('id').'zip'));
    }
}
