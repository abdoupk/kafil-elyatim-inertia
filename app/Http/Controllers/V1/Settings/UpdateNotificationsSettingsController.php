<?php

namespace App\Http\Controllers\V1\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Settings\UpdateNotificationsRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class UpdateNotificationsSettingsController extends Controller implements HasMiddleware
{
    public function __invoke(UpdateNotificationsRequest $request)
    {
        auth()->user()->settings->update([
            'notifications' => $request->validated(),
        ]);

        return response('', 204);
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
