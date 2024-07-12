<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Financial\FinancialIndexResource;
use App\Http\Resources\V1\Members\MemberResource;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class FinancialIndexController extends Controller
{
    public function __invoke(): Response
    {
        ray(FinancialIndexResource::collection(getFinances()));

        return Inertia::render('Tenant/financials/index/FinancialIndexPage', [
            'finances' => FinancialIndexResource::collection(getFinances()),
            'members' => MemberResource::collection(User::select(['id', 'first_name', 'last_name'])->get()),
            'params' => getParams(),
        ]);
    }
}
