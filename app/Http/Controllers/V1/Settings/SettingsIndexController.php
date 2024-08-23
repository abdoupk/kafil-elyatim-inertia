<?php

namespace App\Http\Controllers\V1\Settings;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\SiteSetting\SiteSettingsIndexResource;
use App\Models\Tenant;
use Inertia\Inertia;
use Inertia\Response;

class SettingsIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/settings/SettingsIndexPage', [
            'settings' => SiteSettingsIndexResource::make(Tenant::whereId(tenant('id'))->first()),
        ]);
    }
}
