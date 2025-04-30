<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoStaticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'info_section_title',
        'work_hours',
        'email',
        'phone_number',
        'whatsapp_number',
        'address_1',
        'address_2',
        'ios_app_link',
        'android_app_link',
        'x_link',
        'linkedin_link',
        'youtube_link'
    ];
}
