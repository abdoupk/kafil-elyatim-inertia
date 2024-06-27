<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\RedirectResponse;

class BranchDeleteController extends Controller
{
    public function __invoke(Branch $branch): RedirectResponse
    {
        $branch->delete();

        return redirect()->back();
    }
}
