<?php

namespace App\Http\Controllers\V1\Orphans;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;

class OrphanStoreController extends Controller implements HasMiddleware
{
    public function __invoke() {}

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
