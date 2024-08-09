<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Baby;
use App\Models\Family;
use App\Models\FamilySponsorship;
use App\Models\OrphanSponsorship;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

$last_academic_year = (now()->year) - 1;

define('FILTER_SCHOOL_ENTRY', "AND school_bag = true AND school_bag IS NOT NULL AND orphan.academic_achievement.academic_year IS NOT EMPTY AND orphan.academic_achievement.academic_year >= $last_academic_year");

const FILTER_RAMADAN_BASKET = 'AND ramadan_basket != false AND ramadan_basket IS NOT NULL';

const FILTER_MONTHLY_BASKET = 'AND ramadan_basket != false AND ramadan_basket IS NOT NULL';

const FILTER_EID_SUIT = 'AND eid_suit = true AND eid_suit IS NOT NULL';

const FILTER_EID_AL_ADHA = 'AND eid_al_adha != false AND eid_al_adha IS NOT NULL';

const LIMIT = 5000;

function listOfFamiliesBenefitingFromTheEidAlAdhaSponsorship(): LengthAwarePaginator
{
    return search(FamilySponsorship::getModel(), additional_filters: FILTER_EID_AL_ADHA)
        ->query(fn ($query) => $query
            ->with(['family:id,address,zone_id,branch_id', 'family.sponsor:id,first_name,last_name,family_id,phone_number', 'family.zone:id,name', 'family.branch:id,name', 'family.orphans:id,family_id', 'family.sponsor.incomes', 'family.secondSponsor:id,family_id,income']))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
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

function listOfFamiliesBenefitingFromTheRamadanBasketSponsorship(): LengthAwarePaginator
{
    return search(FamilySponsorship::getModel(), additional_filters: FILTER_RAMADAN_BASKET)
        ->query(fn ($query) => $query
            ->with(['family:id,address,zone_id,branch_id', 'family.sponsor:id,first_name,last_name,family_id,phone_number', 'family.zone:id,name', 'family.branch:id,name', 'family.orphans:id,family_id', 'family.sponsor.incomes', 'family.secondSponsor']))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function listOfOrphansBenefitingFromTheEidSuitSponsorship(): LengthAwarePaginator
{
    return search(OrphanSponsorship::getModel(), FILTER_EID_SUIT)
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
