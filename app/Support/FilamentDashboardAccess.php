<?php

namespace App\Support;

use App\Models\User;

class FilamentDashboardAccess
{
    public static function userHasFullAccess(?User $user = null): bool
    {
        $user ??= auth()->user();

        if (! $user?->email) {
            return false;
        }

        $fullAccessEmails = collect(config('filament-dashboard.full_access_emails', []))
            ->filter()
            ->map(fn (string $email): string => mb_strtolower($email))
            ->all();

        return in_array(mb_strtolower($user->email), $fullAccessEmails, true);
    }

    public static function userIsEvaluationTransactionsOnly(?User $user = null): bool
    {
        $user ??= auth()->user();

        return $user !== null && ! self::userHasFullAccess($user);
    }
}
