<?php

namespace App\Http\Controllers\V1\SiteSettings;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SiteSettings\UpdateSiteInfosRequest;

class SiteSettingUpdateInfosController extends Controller
{
    public function __invoke(UpdateSiteInfosRequest) {}
}
