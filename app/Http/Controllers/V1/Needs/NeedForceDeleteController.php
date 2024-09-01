<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Models\Need;
use Illuminate\Routing\Controllers\HasMiddleware;

class NeedForceDeleteController extends Controller implements HasMiddleware
{
    public function __invoke(Need $need) {}

    public static function middleware()
    {
        return ['can:destroy_trash'];
    }
}
