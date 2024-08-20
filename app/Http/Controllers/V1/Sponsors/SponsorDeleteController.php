<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Jobs\V1\Sponsor\SponsorTrashedJob;
use App\Models\Sponsor;
use Illuminate\Http\RedirectResponse;

class SponsorDeleteController extends Controller
{
    public function __invoke(Sponsor $sponsor): RedirectResponse
    {
        $sponsor->delete();

        dispatch(new SponsorTrashedJob($sponsor, auth()->user()));

        return redirect()->back();
    }
}
