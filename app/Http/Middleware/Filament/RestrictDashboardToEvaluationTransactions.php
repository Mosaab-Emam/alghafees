<?php

namespace App\Http\Middleware\Filament;

use App\Support\FilamentDashboardAccess;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictDashboardToEvaluationTransactions
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->is('dashboard') && ! $request->is('dashboard/*')) {
            return $next($request);
        }

        if (! FilamentDashboardAccess::userIsEvaluationTransactionsOnly($request->user())) {
            return $next($request);
        }

        if ($request->is('dashboard')) {
            return redirect()->route('filament.dashboard.resources.evaluation-transactions.index');
        }

        if (
            $request->is('dashboard/evaluation-transactions') ||
            $request->is('dashboard/evaluation-transactions/*') ||
            $request->is('dashboard/logout')
        ) {
            return $next($request);
        }

        abort(403);
    }
}
