<?php

namespace App\Http\Controllers\V1\Events;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventForceDeleteController extends Controller
{
    public function __invoke(Event $event) {}
}
