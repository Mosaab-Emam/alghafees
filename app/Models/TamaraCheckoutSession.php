<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TamaraCheckoutSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate_request_id',
        'order_id',
        'checkout_id',
        'checkout_url',
        'status',
    ];

    public function rateRequest()
    {
        return $this->belongsTo(RateRequest::class);
    }

    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'new' => 'info',
            'expired' => 'gray',
            'approved' => 'success',
        };
    }

    public function getStatusArAttribute()
    {
        return match ($this->status) {
            'new' => 'جديد',
            'expired' => 'منتهى الصلاحية',
            'approved' => 'مقبول',
        };
    }
}
