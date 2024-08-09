<?php

use App\Models\Baby;
use App\Models\Family;
use App\Models\FamilySponsorship;
use App\Models\OrphanSponsorship;
use Illuminate\Database\Eloquent\Collection;

function getBabiesForExport(): Collection
{
    return search(Baby::getModel(), 'AND orphan.birth_date >'.strtotime('now - 2 years'), limit: 10000)
        ->query(fn ($query) => $query
            ->with(['orphan:id,first_name,last_name,family_id,birth_date,sponsor_id,gender', 'orphan.sponsor:id,first_name,last_name,phone_number', 'orphan.family.zone:id,name'])
        )->get();
}

function listOfOrphansBenefitingFromTheEidSuitSponsorshipForExport(): Collection
{
    return search(OrphanSponsorship::getModel(), FILTER_EID_SUIT, limit: 10000)
        ->query(fn ($query) => $query
            ->with(['orphan:id,first_name,last_name,family_id,sponsor_id,shoes_size,pants_size,shirt_size', 'orphan.sponsor:id,first_name,last_name,phone_number', 'orphan.family.zone:id,name'])
        )
        ->get();
}

function listOfFamiliesBenefitingFromTheRamadanBasketSponsorshipForExport(): Collection
{
    return search(FamilySponsorship::getModel(), additional_filters: FILTER_RAMADAN_BASKET, limit: 10000)
        ->query(fn ($query) => $query
            ->with(['family:id,address,zone_id,branch_id', 'family.sponsor:id,first_name,last_name,family_id,phone_number', 'family.zone:id,name', 'family.branch:id,name', 'family.orphans:id,family_id', 'family.sponsor.incomes', 'family.secondSponsor']))->get();
}

function listOfOrphansBenefitingFromTheSchoolEntrySponsorshipForExport(): Collection
{
    return search(OrphanSponsorship::getModel(), FILTER_SCHOOL_ENTRY, 10000)
        ->query(fn ($query) => $query
            ->with(['orphan.sponsor:id,first_name,last_name,phone_number', 'orphan', 'orphan.lastAcademicYearAchievement.academicLevel', 'orphan.family.zone:id,name'])
        )->get();
}

function listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport(): Collection
{
    return search(FamilySponsorship::getModel(), additional_filters: FILTER_EID_AL_ADHA, limit: LIMIT)
        ->query(fn ($query) => $query
            ->with(['family:id,address,zone_id,branch_id', 'family.sponsor:id,first_name,last_name,family_id,phone_number', 'family.zone:id,name', 'family.branch:id,name', 'family.orphans:id,family_id', 'family.sponsor.incomes', 'family.secondSponsor:id,family_id,income']))
        ->get();
}

function listOfFamiliesBenefitingFromTheMonthlyBasketForExport(): Collection
{
    //    $filters = ['monthly_allowance', '=', true];

    return search(Family::getModel())
        ->query(fn ($query) => $query->with('zone'))
        ->get();
}
