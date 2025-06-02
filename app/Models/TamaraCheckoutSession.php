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
            'authorised' => 'success',
            'canceled' => 'danger',
            'fully_refunded' => 'danger',
            'partially_refunded' => 'warning',
            'fully_captured' => 'success',
            'partially_captured' => 'warning',
            'updated' => 'info',
        };
    }

    public function getStatusArAttribute()
    {
        return match ($this->status) {
            'new' => 'جديد',
            'expired' => 'منتهى الصلاحية',
            'approved' => 'مقبول',
            'authorised' => 'مؤكد',
            'canceled' => 'ملغي',
            'fully_refunded' => 'مسترجع بالكامل',
            'partially_refunded' => 'مسترجع جزئيا',
            'fully_captured' => 'تم تحصيله بالكامل',
            'partially_captured' => 'تم تحصيله جزئياً',
            'updated' => 'محدث',
        };
    }
}
