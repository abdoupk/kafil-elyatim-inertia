<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ArchiveDetailsRamadanBasketController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/archive/details/ramadan-basket/RamadanBasketArchiveDetailsPage');
    }
}
