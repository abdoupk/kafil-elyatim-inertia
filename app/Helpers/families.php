<?php

/** @noinspection UnknownInspectionInspection */

use App\Models\Family;
use App\Models\Orphan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

function getFamilies(): LengthAwarePaginator
{
    return search(Family::getModel())
        ->query(fn ($query) => $query->with('zone'))
        ->paginate(perPage: request()?->integer('perPage', 10));
}

function getFamiliesForExport(): Collection
{
    return search(Family::getModel(), limit: 10000)
        ->query(fn ($query) => $query->with(['zone:id,name', 'branch:id,name', 'sponsor.incomes', 'secondSponsor:id,income,family_id', 'orphans:id,income,family_id'])->withCount('orphans'))->get();
}

function searchFamilies(): \Illuminate\Database\Eloquent\Collection
{
    return search(Family::getModel(), limit: LIMIT)->get();
}

function calculateTotalIncomes(Family $family): float
{
    return (float) $family->sponsor?->incomes->total_income + (float) $family->orphans?->sum('income') + $family->secondSponsor?->income;
}

function calculateIncomeRate(Family $family): float
{
    return 0.00;
}

function calculateWeights() {}

function calculateSponsorWeights(Family $family): float
{
    $weights = $family->tenant['calculation']['weights']['sponsor'];

    return match ($family->sponsor->sponsor_type) {
        'other' => $weights['other'],
        'widower' => $weights['widower'],
        'widow' => $weights['widow'],
        'widows_husband' => $weights['widows_husband'],
        'mother_of_a_supported_childhood' => $weights['mother_of_a_supported_childhood'],
        'widowers_wife' => $weights['widowers_wife'],
    };
}

function calculateOrphanWeights(Orphan $orphan): float
{
    $orphanWeights = $orphan->tenant['calculation']['weights']['orphans'];

    if ($orphan->is_handicapped) {
        return $orphanWeights['handicapped'];
    }

    if ($orphan->birth_date->age < 18) {
        return calculateWeightForOrphanBelow18($orphan, $orphanWeights);
    } else {
        if ($orphan->gender == 'male') {
            return calculateWeightForOrphanMaleOlderThan18($orphan, $orphanWeights);
        } else {
            return calculateWeightForOrphanFemaleOlderThan18($orphan, $orphanWeights);
        }
    }
}

function calculateWeightForOrphanFemaleOlderThan18(Orphan $orphan, array $weights): float
{
    $weights = $weights['female_gt_18'];

    return match ($orphan->family_status) {
        'college_girl' => $weights['college_girl'],
        'professional_girl' => $weights['professional_girl'],
        'at_home_with_no_income' => $weights['at_home_with_no_income'],
        'at_home_with_income' => $weights['at_home_with_income'],
        'single_female_employee' => $weights['single_female_employee'],
        'married' => $weights['married'],
        'divorced' => $weights['divorced'],
    };
}

function calculateWeightForOrphanMaleOlderThan18(Orphan $orphan, array $weights): float
{
    $weights = $weights['female_gt_18'];

    return match ($orphan->family_status) {
        'college_boy' => $weights['college_boy'],
        'professional_boy' => $weights['professional_boy'],
        'unemployed' => $weights['unemployed'],
        'worker_with_family' => $weights['worker_with_family'],
        'worker_outside_family' => $weights['worker_outside_family'],
        'married_with_family' => $weights['married_with_family'],
        'married_outside_family' => $weights['married_outside_family'],
    };
}

function calculateWeightForOrphanBelow18(Orphan $orphan, $weights): float
{
    if (date('m') <= 9 && date('m') >= 6) {
        if ($orphan->birth_date->age < 2) {
            return $weights['lt_18']['outside_academic_season']['baby'];
        }

        if ($orphan->birth_date->age <= 5 && $orphan->birth_date->age > 2) {
            return $weights['lt_18']['outside_academic_season']['below_school_age'];
        }

        if ($orphan->academicLevel->level === 'مفصول') {
            return $weights['lt_18']['outside_academic_season']['dismissed'];
        }

        if ($orphan->family_status === 'professional_girl' || $orphan->family_status === 'professional_boy') {
            return $weights['lt_18']['outside_academic_season']['professionals'];
        }

        return match ($orphan->academicLevel->phase) {
            'الطور الابتدائي' => $weights['lt_18']['outside_academic_season']['elementary_school'],
            'الطور المتوسط' => $weights['lt_18']['outside_academic_season']['middle_school'],
            'الطور الثانوي' => $weights['lt_18']['outside_academic_season']['high_school'],
            default => 1
        };
    } else {
        if ($orphan->birth_date->age < 2) {
            return $weights['lt_18']['during_academic_season']['baby'];
        }

        if ($orphan->birth_date->age <= 5 && $orphan->birth_date->age > 2) {
            return $weights['lt_18']['during_academic_season']['below_school_age'];
        }

        if ($orphan->academicLevel->level === 'مفصول') {
            return $weights['lt_18']['during_academic_season']['dismissed'];
        }

        if ($orphan->family_status === 'professional_girl' || $orphan->family_status === 'professional_boy') {
            return $weights['lt_18']['during_academic_season']['professionals'];
        }

        return match ($orphan->academicLevel->phase) {
            'الطور الابتدائي' => $weights['lt_18']['during_academic_season']['elementary_school'],
            'الطور المتوسط' => $weights['lt_18']['during_academic_season']['middle_school'],
            'الطور الثانوي' => $weights['lt_18']['during_academic_season']['high_school'],
            default => 1
        };
    }
}
