<?php

namespace App\Http\Middleware;

use App\Enums\Lang;
use App\Http\Resources\V1\LanguageResource;
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
                'user' => $request->user(),
                'settings' => auth()->user()?->settings,
            ],
            'language' => 'ar', // TODO: change to get automatically app()->getLocale()
            'languages' => LanguageResource::collection(Lang::cases()),
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
