<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Baby;
use App\Models\Family;
use App\Models\FamilySponsorship;
use App\Models\OrphanSponsorship;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

$last_academic_year = (now()->year) - 1;
define('FILTER_SCHOOL_ENTRY', "AND school_bag = true AND school_bag IS NOT NULL AND orphan.academic_achievement.academic_year IS NOT EMPTY AND orphan.academic_achievement.academic_year >= $last_academic_year");

function listOfFamiliesBenefitingFromTheEidAlAdhaSponsorship(): LengthAwarePaginator
{
    return search(FamilySponsorship::getModel(), 'AND eid_al_adha != false AND eid_al_adha IS NOT NULL')
        ->query(fn ($query) => $query
            ->with(['family:id,address,zone_id,branch_id', 'family.sponsor:id,first_name,last_name,family_id,phone_number', 'family.zone:id,name', 'family.branch:id,name', 'family.orphans:id,family_id', 'family.sponsor.incomes', 'family.secondSponsor:id,family_id,income']))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function listOfFamiliesBenefitingFromTheEidAlAdhaSponsorshipForExport(): Collection
{
    return search(FamilySponsorship::getModel(), additional_filters: 'AND eid_al_adha != false AND eid_al_adha IS NOT NULL', limit: 10000)
        ->query(fn ($query) => $query
            ->with(['family:id,address,zone_id,branch_id', 'family.sponsor:id,first_name,last_name,family_id,phone_number', 'family.zone:id,name', 'family.branch:id,name', 'family.orphans:id,family_id', 'family.sponsor.incomes', 'family.secondSponsor:id,family_id,income']))
        ->get();
}

function listOfFamiliesBenefitingFromTheMonthlyBasket(): LengthAwarePaginator
{
    //    $filters = ['monthly_allowance', '=', true];

    return search(Family::getModel())
        ->query(fn ($query) => $query->with('zone'))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function listOfOrphansBenefitingFromTheSchoolEntrySponsorship(): LengthAwarePaginator
{
    return search(OrphanSponsorship::getModel(), additional_filters: FILTER_SCHOOL_ENTRY)
        ->query(fn ($query) => $query
            ->with(['orphan.sponsor:id,first_name,last_name,phone_number', 'orphan.lastAcademicYearAchievement.academicLevel', 'orphan.family.zone:id,name'])
        )
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function listOfOrphansBenefitingFromTheSchoolEntrySponsorshipForExport(): Collection
{
    return search(OrphanSponsorship::getModel(), FILTER_SCHOOL_ENTRY, 10000)
        ->query(fn ($query) => $query
            ->with(['orphan.sponsor:id,first_name,last_name,phone_number', 'orphan', 'orphan.lastAcademicYearAchievement.academicLevel', 'orphan.family.zone:id,name'])
        )->get();
}

function listOfFamiliesBenefitingFromTheRamadanBasketSponsorship(): LengthAwarePaginator
{
    return search(FamilySponsorship::getModel(), 'AND ramadan_basket != false AND ramadan_basket IS NOT NULL')
        ->query(fn ($query) => $query
            ->with(['family:id,address,zone_id,branch_id', 'family.sponsor:id,first_name,last_name,family_id,phone_number', 'family.zone:id,name', 'family.branch:id,name', 'family.orphans:id,family_id', 'family.sponsor.incomes', 'family.secondSponsor']))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function listOfOrphansBenefitingFromTheEidSuitSponsorship(): LengthAwarePaginator
{
    return search(OrphanSponsorship::getModel(), 'AND eid_suit = true AND eid_suit IS NOT NULL')
        ->query(fn ($query) => $query
            ->with(['orphan:id,first_name,last_name,family_id,sponsor_id,shoes_size,pants_size,shirt_size', 'orphan.sponsor:id,first_name,last_name,phone_number', 'orphan.family.zone:id,name'])
        )
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function listOfBabies(): LengthAwarePaginator
{
    return search(Baby::getModel(), 'AND orphan.birth_date >'.strtotime('now - 2 years'))
        ->query(fn ($query) => $query
            ->with(['orphan:id,first_name,last_name,family_id,birth_date,sponsor_id', 'orphan.sponsor:id,first_name,last_name,phone_number', 'orphan.family.zone:id,name'])
        )
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function getBabiesForExport(): Collection
{
    return search(Baby::getModel(), 'AND orphan.birth_date >'.strtotime('now - 2 years'), limit: 10000)
        ->query(fn ($query) => $query
            ->with(['orphan:id,first_name,last_name,family_id,birth_date,sponsor_id,gender', 'orphan.sponsor:id,first_name,last_name,phone_number', 'orphan.family.zone:id,name'])
        )->get();
}
