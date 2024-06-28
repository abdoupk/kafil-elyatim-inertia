<?php

namespace App\Http\Controllers\V1\Branches;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\JsonResponse;

class BranchShowController extends Controller
{
    public function __invoke(Branch $branch): JsonResponse
    {
        return response()->json([
            'branch' => $branch->load(['city', 'president']),
        ]);
    }
}
