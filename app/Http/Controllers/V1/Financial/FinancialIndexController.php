<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class FinancialIndexController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Tenant/financials/FinancialIndexPage');
    }
}
