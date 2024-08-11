<?php

const LIMIT = 5000;

const DONATION_SPECIFICATION = ['drilling_wells', 'monthly_sponsorship',
    'eid_el_adha', 'eid_el_fitr', 'other', 'school_entry', 'analysis',
    'therapy', 'ramadan_basket'];

const DEFAULT_NOTIFICATIONS = [
    'branch' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'zone' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'orphan' => [
        'deleted' => true,
        'updated' => true,
    ],
    'sponsor' => [
        'deleted' => true,
        'updated' => true,
    ],
    'family' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'school' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'lesson' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'member' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
    'need' => [
        'created' => true,
        'deleted' => true,
        'updated' => true,
    ],
];

const FILTER_RAMADAN_BASKET = 'AND ramadan_basket != false AND ramadan_basket IS NOT NULL';

const FILTER_MONTHLY_BASKET = 'AND ramadan_basket != false AND ramadan_basket IS NOT NULL';

const FILTER_EID_SUIT = 'AND eid_suit = true AND eid_suit IS NOT NULL';

const FILTER_EID_AL_ADHA = 'AND eid_al_adha != false AND eid_al_adha IS NOT NULL';

$last_academic_year = (now()->year) - 1;

define('FILTER_SCHOOL_ENTRY', "AND school_bag = true AND school_bag IS NOT NULL AND orphan.academic_achievement.academic_year IS NOT EMPTY AND orphan.academic_achievement.academic_year >= $last_academic_year");
