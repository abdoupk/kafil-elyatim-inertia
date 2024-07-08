<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Family;
use App\Models\FamilySponsorship;
use App\Models\OrphanSponsorship;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

function listOfFamiliesBenefitingFromTheEidAlAdhaSponsorship(): LengthAwarePaginator
{
    return search(FamilySponsorship::getModel(), 'AND eid_al_adha != false AND eid_al_adha IS NOT NULL')
        ->query(fn ($query) => $query
            ->with(['family:id,address,zone_id,branch_id', 'family.sponsor:id,first_name,last_name,family_id,phone_number', 'family.zone:id,name', 'family.branch:id,name', 'family.orphans:id,family_id', 'family.sponsor.incomes']))
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
    return search(OrphanSponsorship::getModel(), 'AND school_bag = true AND school_bag IS NOT NULL')
        ->query(fn ($query) => $query
            ->with(['orphan.sponsor', 'orphan.lastAcademicYearAchievement', 'orphan.family.zone'])
        )
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}

function listOfFamiliesBenefitingFromTheRamadanBasketSponsorship(): LengthAwarePaginator
{
    return search(FamilySponsorship::getModel(), 'AND ramadan_basket != false AND ramadan_basket IS NOT NULL')
        ->query(fn ($query) => $query
            ->with(['family:id,address,zone_id,branch_id', 'family.sponsor:id,first_name,last_name,family_id,phone_number', 'family.zone:id,name', 'family.branch:id,name', 'family.orphans:id,family_id', 'family.sponsor.incomes']))
        /** @phpstan-ignore-next-line */
        ->paginate(perPage: request()?->input('perPage', 10));
}
