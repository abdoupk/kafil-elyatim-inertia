<?php

namespace App\Http\Controllers\V1\SiteSettings;

use App\Http\Controllers\Controller;
use Storage;

class DownloadExportedDataController extends Controller
{
    public function __invoke()
    {
        //        ray(('exported_data.zip'));

        return response()->download(Storage::path('exported_data.zip'));
    }
}
