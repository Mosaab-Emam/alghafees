<?php

namespace App\Models;

use App\Models\Evaluation\EvaluationEmployee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkTracker extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id',
        'employee_id',
        'type_id',
        'number',
        'ended_at',
        'notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'ended_at' => 'datetime'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    public function employee()
    {
        return $this->belongsTo(EvaluationEmployee::class, 'employee_id');
    }

    public function type()
    {
        return $this->belongsTo(Category::class, 'type_id');
    }

    public function getTimeTakenAttribute()
    {
        if (!$this->ended_at) {
            return null;
        }
        return $this->ended_at->diffForHumans($this->created_at, ['syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]);
    }

    public function getTotalEndedTodayAttribute()
    {
        return WorkTracker::where('employee_id', $this->employee_id)
            ->where('ended_at', '>=', now()->startOfDay())
            ->count();
    }

    public function getTotalEndedThisMonthAttribute()
    {
        return WorkTracker::where('employee_id', $this->employee_id)
            ->where('ended_at', '>=', now()->startOfMonth())
            ->count();
    }
}

