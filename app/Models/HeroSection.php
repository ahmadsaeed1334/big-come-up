<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'subtitle',
        'title',
        'description',
        'primary_btn_text',
        'primary_btn_link',
        'secondary_btn_text',
        'secondary_btn_link',
    ];
}
