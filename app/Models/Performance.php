<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'platform',
        'thumb_path',
        'video_url',
    ];

    public function artist()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function artistsVote()
    {
        return $this->hasMany(ArtistsVote::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function watches()
    {
        return $this->hasMany(WatchHistory::class);
    }
}
