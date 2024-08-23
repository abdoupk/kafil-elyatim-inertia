<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class RegistrationDomainRequiredRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //        if (tenant('id')) {
        //
        //        }

        if (! Str::remove('.'.config('tenancy.central_domains')[0], $value)) {
            $fail(trans('validation.required', [':attribute' => $attribute]));
        }
    }
}
