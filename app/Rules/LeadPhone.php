<?php

namespace App\Rules;

use App\Support\LeadContactData;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LeadPhone implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! LeadContactData::validPhone($value)) {
            $fail(__('leads.invalid_phone'));
        }
    }
}
