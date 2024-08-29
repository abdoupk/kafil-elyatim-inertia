<?php

namespace App\Http\Controllers\V1\AcademicLevel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controllers\HasMiddleware;

class AcademicLevelIndexController extends Controller implements HasMiddleware
{
    public function __invoke()
    {
        return response()->json(JsonResource::collection(formatedAcademicLevels()));
    }

    public static function middleware()
    {
        // TODO: Implement middleware() method.
    }
}
