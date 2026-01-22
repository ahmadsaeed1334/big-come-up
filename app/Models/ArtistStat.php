<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArtistStat extends Model
{
    use HasFactory;

    protected $table = 'artist_stats';

    protected $fillable = [
        'user_id',
        'artists_followed_count',
        'competitions_count',
        'liked_stories_count',
        'followers_count',
        'wins_count',
    ];

    protected $casts = [
        'artists_followed_count' => 'integer',
        'competitions_count' => 'integer',
        'liked_stories_count' => 'integer',
        'followers_count' => 'integer',
        'wins_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
