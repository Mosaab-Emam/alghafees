<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class FilamentDashboardEvaluationTransactionScope implements Scope
{
    public const YEAR = 2026;

    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('created_at', '>=', self::YEAR . '-01-01 00:00:00')
            ->where('created_at', '<', (self::YEAR + 1) . '-01-01 00:00:00');
    }
}
