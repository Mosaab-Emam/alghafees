<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['has_been_signed', 'contract_date'];

    public function getHasBeenSignedAttribute()
    {
        return !!$this->signature;
    }

    public function getContractDateAttribute()
    {
        if ($this->date)
            return $this->date;

        return explode(' ', $this->created_at)[0];
    }

    public function getSignatureStatusAttribute()
    {
        if ($this->signature == null) return __('admin.null_signature');
        if (str_starts_with($this->signature, 'data')) return __('admin.electronic_signature');
        return __('admin.paper_signature');
    }
}
