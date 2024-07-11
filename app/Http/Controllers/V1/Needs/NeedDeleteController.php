<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Models\Need;

class NeedDeleteController extends Controller
{
    public function __invoke(Need $need)
    {
        $need->delete();

        return redirect()->back();
    }
}
