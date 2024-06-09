<?php

namespace App\Enums;

enum SponsorshipType
{
    case FOR_FAMILY;

    case FOR_ORPHAN;

    case FOR_SPONSOR;

    public function label(): string
    {
        return match ($this) {
            self::FOR_FAMILY => __('for_family'),
            self::FOR_ORPHAN => __('for_orphan'),
            self::FOR_SPONSOR => __('for_sponsor'),
        };
    }
}
