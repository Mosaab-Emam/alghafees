<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'file', 'type'];

    public function scopeReports(Builder $query): Builder
    {
        return $query->where('type', 'report');
    }

    public function scopeEvaluations(Builder $query): Builder
    {
        return $query->where('type', 'evaluation');
    }
}
