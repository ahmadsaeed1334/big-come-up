<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SweepstakesSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'receive_notifications',
        'show_wins_publicly',
    ];

    protected $casts = [
        'receive_notifications' => 'boolean',
        'show_wins_publicly' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
