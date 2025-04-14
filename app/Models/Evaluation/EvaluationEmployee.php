<?php

namespace App\Models\Evaluation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use App\Models\Scopes\ActiveScope;
use App\Models\WorkTracker;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ScopedBy([ActiveScope::class])]
class EvaluationEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'position',
        'active',
        'has_visible_tracker',
    ];

    public function transactionpreviewer()
    {
        return $this->hasMany(EvaluationTransaction::class, 'previewer_id');
    }

    public function transactionincome()
    {
        return $this->hasMany(EvaluationTransaction::class, 'income_id');
    }

    public function workTrackers(): HasMany
    {
        return $this->hasMany(WorkTracker::class, 'employee_id');
    }

    public function transactionreview()
    {
        return $this->hasMany(EvaluationTransaction::class, 'review_id');
    }

    public function getTotalAttribute()
    {
        return $this->transactionincome_count * .5 + $this->transactionpreviewer_count + $this->transactionreview_count * .5;
    }

    public function getStatsAttribute()
    {
        $previews = $this->transactionpreviewer->count();
        $entries = $this->transactionincome->count() * .5;
        $reviews = $this->transactionreview->count() * .5;
        $total = $previews + $entries + $reviews;

        return [
            'total' => $total,
            'previews' => $previews,
            'entries' => $entries,
            'reviews' => $reviews
        ];
    }

    public function getQueryStats(Builder $query)
    {
        $items = $query->get();
        $previews = 0;
        $entries = 0;
        $reviews = 0;

        foreach ($items as $item) {
            if ($item->previewer_id == $this->id)
                $previews += 1;
            if ($item->income_id == $this->id)
                $entries += 0.5;
            if ($item->review_id == $this->id)
                $reviews += 0.5;
        }

        $total = $previews + $entries + $reviews;

        return [
            'total' => $total,
            'previews' => $previews,
            'entries' => $entries,
            'reviews' => $reviews
        ];
    }

    public function getClosestUnendedWorkTrackerAttribute(): WorkTracker|null
    {
        return WorkTracker::where('employee_id', $this->id)
            ->whereNull('ended_at')
            ->orderBy('created_at', 'asc')
            ->first();
    }

    public function getTotalTrackersEndedTodayAttribute(): int
    {
        return WorkTracker::where('employee_id', $this->id)
            ->where('ended_at', '>=', now()->startOfDay())
            ->count();
    }

    public function getTotalTrackersEndedThisMonthAttribute(): int
    {
        return WorkTracker::where('employee_id', $this->id)
            ->where('ended_at', '>=', now()->startOfMonth())
            ->count();
    }
}
