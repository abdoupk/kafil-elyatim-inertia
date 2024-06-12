<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use Inertia\Response;

class OrphanShowController extends Controller
{
    public function __invoke(): Response
    {
        return inertia()->render('Tenant/orphans/OrphanDetailPage');
    }
}
