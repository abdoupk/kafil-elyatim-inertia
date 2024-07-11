<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Needs\NeedUpdateResource;
use App\Models\Need;

class NeedShowController extends Controller
{
    public function __invoke(Need $need)
    {
        return response()->json([
            'need' => NeedUpdateResource::make($need),
        ]);
    }
}
