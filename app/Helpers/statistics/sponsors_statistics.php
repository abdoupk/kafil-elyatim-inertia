<?php

use App\Models\Sponsor;
use App\Models\SponsorSponsorship;

function getSponsorsBySponsorType(): array
{
    $sponsors = Sponsor::select('sponsor_type', DB::raw('count(*) as total'))->groupBy('sponsor_type')->get();

    return [
        'labels' => $sponsors->pluck('sponsor_type')->toArray(),
        'data' => $sponsors->pluck('total')->toArray(),
    ];
}

function getSponsorsByAcademicLevel(): array
{
    $sponsors = Sponsor::select('academic_level_id', DB::raw('count(*) as total'))->with('academicLevel:id,phase')
        ->groupBy('academic_level_id')
        ->get();

    return [
        'labels' => $sponsors->pluck('academicLevel.phase')->toArray(),
        'data' => $sponsors->pluck('total')->toArray(),
    ];
}

function getSponsorsBySponsorship(): array
{
    $sponsorships = SponsorSponsorship::selectRaw('
    SUM(CASE WHEN literacy_lessons != \'0\' THEN 1 ELSE 0 END) AS literacy_lessons_count,
    SUM(CASE WHEN direct_sponsorship != \'0\' THEN 1 ELSE 0 END) AS direct_sponsorship_count,
    SUM(CASE WHEN project_support != \'0\' THEN 1 ELSE 0 END) AS project_support_count,
     SUM(CASE WHEN medical_sponsorship != \'0\' THEN 1 ELSE 0 END) AS medical_sponsorship_count
')
        ->first();

    return [
        'literacy_lessons_count' => $sponsorships->literacy_lessons_count,
        'direct_sponsorship_count' => $sponsorships->direct_sponsorship_count,
        'project_support_count' => $sponsorships->project_support_count,
        'medical_sponsorship_count' => $sponsorships->medical_sponsorship_count,
    ];
}

function getSponsorsByDiploma(): array
{
    $sponsors = Sponsor::select('diploma', DB::raw('count(*) as total'))->groupBy('diploma')->get();

    return [
        'labels' => $sponsors->pluck('diploma')->toArray(),
        'data' => $sponsors->pluck('total')->toArray(),
    ];
}
