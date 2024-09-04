<?php

namespace App\Http\Controllers\V1\SiteSettings;

use App\Http\Controllers\Controller;
use App\Jobs\V1\SiteSettings\ExportDataJob;

class ExportFullDataController extends Controller
{
    public function __invoke()
    {
        new ExportDataJob(tenant('id'));

        return response('', 200);
    }
}
