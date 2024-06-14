<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\RegisterTenantRequest;
use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredTenantController extends Controller
{
    public function store(RegisterTenantRequest $request): JsonResponse
    {
        $tenant = Tenant::create($request->validated());

        Domain::create([
            'domain' => $request->domain,
            'tenant_id' => $tenant->id,
        ]);

        /** @var Domain $domain */
        $domain = $tenant->domains->first();

        return response()->json(['url' => tenant_route($domain->domain, 'tenant.login')]);
    }

    public function create(): Response
    {
        return Inertia::render('Auth/Register/RegisterPage');
    }
}
