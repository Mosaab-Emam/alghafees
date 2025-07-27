<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_type_id',
        'cv_file',
        'university_name',
        'training_period',
        'starting_date',
        'phone_number',
    ];

    public function trainingType()
    {
        return $this->hasOne(TrainingType::class);
    }
}
