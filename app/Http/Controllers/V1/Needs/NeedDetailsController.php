<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Needs\NeedShowResource;
use App\Models\Need;

class NeedDetailsController extends Controller
{
    public function __invoke(Need $need)
    {
        return response()->json([
            'need' => NeedShowResource::make($need->load(['city', 'president:id,last_name,first_name', 'creator:id,first_name,last_name'])->loadCount('families')),
        ]);
    }
}
