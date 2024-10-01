<?php

namespace App\Http\Controllers\V1\SiteSettings;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\SiteSettings\UpdateSiteInfosRequest;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controllers\HasMiddleware;

class SiteSettingUpdateInfosController extends Controller implements HasMiddleware
{
    public function __invoke(UpdateSiteInfosRequest $request): ResponseFactory|Application|Response
    {
        $data = $request->except('super_admin');

        $superAdmin = User::whereId($request->super_admin)->first();

        $superAdmin->syncRoles('super_admin');

        $data['super_admin'] = [
            'id' => $superAdmin->id,
            'first_name' => $superAdmin->first_name,
            'last_name' => $superAdmin->last_name,
            'name' => $superAdmin->getName(),
            'email' => $superAdmin->email,
            'password' => $superAdmin->password,
        ];

        $tenant = Tenant::whereId(tenant('id'));
        $domain = $tenant->first()->domains->first->domain;

        $tenant->update([
            'data->infos' => $data,
        ]);

        if ($domain->domain !== $request->domain) {
            $domain->update([
                'domain' => $request->domain,
            ]);

            auth()->logout();

            return response([
                'should_redirect' => true,
                'url' => tenant_route($domain->domain, 'tenant.dashboard'),
            ]);
        }

        return response([
            'should_redirect' => false,
        ], 200);
    }

    public static function middleware(): array
    {
        return ['can:update_settings'];
    }
}
