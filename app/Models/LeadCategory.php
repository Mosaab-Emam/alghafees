<?php

namespace App\Models;

use App\Support\LeadContactData;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LeadCategory extends Model
{
    protected $fillable = ['name'];

    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = LeadContactData::trim($value);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
