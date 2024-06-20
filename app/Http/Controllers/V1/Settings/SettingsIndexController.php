<?php

namespace App\Http\Controllers\V1\Settings;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class SettingsIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/settings/SettingsIndexPage');
    }
}
