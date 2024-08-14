<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Models\Need;

class NeedForceDeleteController extends Controller
{
    public function __invoke(Need $need) {}
}
