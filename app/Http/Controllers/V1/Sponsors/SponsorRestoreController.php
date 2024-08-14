<?php

namespace App\Http\Controllers\V1\Sponsors;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;

class SponsorRestoreController extends Controller
{
    public function __invoke(Sponsor $sponsor) {}
}
