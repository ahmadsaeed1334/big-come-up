<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtistProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'location_city',
        'location_country',
        'avatar_path',
        'banner_path',
        'social_links',
        'is_public',
        'allow_messages',
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_public' => 'boolean',
        'allow_messages' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
