<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Branch\BranchTrashedJob;
use App\Models\Branch;
use Illuminate\Http\RedirectResponse;

class BranchDeleteController extends Controller
{
    public function __invoke(Branch $branch): RedirectResponse
    {
        $branch->unsearchable();

        $branch->delete();

        dispatch(new BranchTrashedJob($branch, auth()->user()));

        return redirect()->back();
    }
}
