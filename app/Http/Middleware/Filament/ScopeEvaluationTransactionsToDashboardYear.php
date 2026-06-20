<?php

namespace App\Http\Middleware\Filament;

use App\Models\Evaluation\EvaluationTransaction;
use App\Models\Scopes\FilamentDashboardEvaluationTransactionScope;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScopeEvaluationTransactionsToDashboardYear
{
    public function handle(Request $request, Closure $next): Response
    {
        EvaluationTransaction::addGlobalScope(
            FilamentDashboardEvaluationTransactionScope::class,
            new FilamentDashboardEvaluationTransactionScope()
        );

        return $next($request);
    }
}
