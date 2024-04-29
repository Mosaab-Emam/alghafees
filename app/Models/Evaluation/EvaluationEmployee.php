<?php

namespace App\Models\Evaluation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;

#[ScopedBy([ActiveScope::class])]
class EvaluationEmployee extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'position',
        'active',
    ];

    public function transactionpreviewer()
    {
        return $this->hasMany(EvaluationTransaction::class, 'previewer_id');
    }

    public function transactionincome()
    {
        return $this->hasMany(EvaluationTransaction::class, 'income_id');
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
        $previews = $query->where('previewer_id', $this->id)->count();
        $entries = $query->where('income_id', $this->id)->count() * .5;
        $reviews = $query->where('review_id', $this->id)->count() * .5;
        $total = $previews + $entries + $reviews;

        return [
            'total' => $total,
            'previews' => $previews,
            'entries' => $entries,
            'reviews' => $reviews
        ];
    }
}
