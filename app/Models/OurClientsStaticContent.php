<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurClientsStaticContent extends Model
{
    use HasFactory;

    protected $fillable = [
        "small_top_title",
        "main_top_title",
        "main_title",
        "main_description",
        "clients_title"
    ];
}
