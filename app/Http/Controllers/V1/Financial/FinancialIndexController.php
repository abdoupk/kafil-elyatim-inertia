<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Financial\FinancialIndexResource;
use Illuminate\Routing\Controllers\HasMiddleware;
use Inertia\Inertia;
use Inertia\Response;

class FinancialIndexController extends Controller implements HasMiddleware
{
    public function __invoke(): Response
    {
        ray(FinancialIndexResource::collection(getFinances()));

        return Inertia::render('Tenant/financials/index/FinancialIndexPage', [
            'finances' => FinancialIndexResource::collection(getFinances()),
            'params' => getParams(),
        ]);
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
