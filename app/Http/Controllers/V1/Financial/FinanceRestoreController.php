<?php

namespace App\Http\Controllers\V1\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;

class FinanceRestoreController extends Controller implements HasMiddleware
{
    public function __invoke() {}

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
