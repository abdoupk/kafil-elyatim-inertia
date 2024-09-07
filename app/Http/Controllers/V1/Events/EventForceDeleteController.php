<?php

namespace App\Http\Controllers\V1\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Routing\Controllers\HasMiddleware;

class EventForceDeleteController extends Controller implements HasMiddleware
{
    public function __invoke(Event $event)
    {
    }

    public static function middleware()
    {
        return ['can:destroy_trash'];
    }
}
