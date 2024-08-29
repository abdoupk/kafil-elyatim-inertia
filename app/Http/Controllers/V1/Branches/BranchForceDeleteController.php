<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Routing\Controllers\HasMiddleware;

class BranchForceDeleteController extends Controller implements HasMiddleware
{
    public function __invoke(Branch $branch) {}

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
