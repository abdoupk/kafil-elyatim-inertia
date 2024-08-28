<?php

namespace App\Http\Middleware;

use App\Enums\Lang;
use App\Http\Resources\V1\LanguageResource;
use Arr;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $this->getAuthData(),
                'settings' => auth()->user()?->settings,
            ],
            'association' => tenant('infos')['association'] ?? null,
            'language' => 'ar', // TODO: change to get automatically app()->getLocale() and remove languages
            'languages' => LanguageResource::collection(Lang::cases()),
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }

    /**
     * @noinspection StaticClosureCanBeUsedInspection
     * @noinspection UnknownInspectionInspection
     */
    protected function getAuthData(): ?array
    {
        if (auth()->user()) {
            return Arr::map(auth()->user()->load(['roles'])->only(['roles', 'id', 'first_name', 'last_name', 'tenant_id']), function ($value, $key) {
                if ($key === 'roles') {
                    return $value->pluck('name')->toArray();
                }

                return $value;
            }) + ['permissions' => auth()->user()->permissions->toArray()];

        }

        return null;
    }
}
