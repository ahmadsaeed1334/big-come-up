<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoginSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device',
        'location',
        'last_seen_at',
        'ip',
        'user_agent',
    ];

    protected $casts = [
        'last_seen_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
