<?php

namespace App\Models\Evaluation;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class EvaluationCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'position',
        'active',
    ];

    public function transaction()
    {
        return $this->hasMany(EvaluationTransaction::class, 'evaluation_company_id');
    }


}
