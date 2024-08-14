<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Models\Branch;

class BranchRestoreController extends Controller
{
    public function __invoke(Branch $orphan) {}
}
