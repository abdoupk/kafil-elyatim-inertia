<?php

namespace App\Http\Controllers\V1\Needs;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Need\NeedTrashedJob;
use App\Models\Need;

class NeedDeleteController extends Controller
{
    public function __invoke(Need $need)
    {
        $need->delete();

        dispatch(new NeedTrashedJob($need, auth()->user()));

        return redirect()->back();
    }
}
