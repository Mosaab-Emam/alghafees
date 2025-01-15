<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsStaticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        "small_top_title",
        "main_top_title",
        "form_title",
        "form_description",
        "title",
        "box_title",
        "phone",
        "email",
        "cta_text",
        "cta_link"
    ];
}
