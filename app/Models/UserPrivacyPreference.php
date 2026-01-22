<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPrivacyPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'public_profile_visibility',
        'show_activity_history',
        'show_votes_publicly',
        'allow_direct_messages',
    ];

    protected $casts = [
        'public_profile_visibility' => 'boolean',
        'show_activity_history' => 'boolean',
        'show_votes_publicly' => 'boolean',
        'allow_direct_messages' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
