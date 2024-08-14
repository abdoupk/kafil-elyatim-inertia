<?php

namespace App\Http\Controllers\V1\Archive;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ArchiveDetailsMonthlyBasketController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/archive/details/monthly-basket/MonthlyBasketArchiveDetailsPage');
    }
}
