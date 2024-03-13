<?php

namespace App\Models\Evaluation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

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

    public function getTotalAttribute() {
         return $this->transactionincome_count * .5 + $this->transactionpreviewer_count + $this->transactionreview_count * .5;
    }


}
