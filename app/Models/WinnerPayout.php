<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WinnerPayout extends Model
{
    protected $fillable = [
        'competition_id',
        'user_id',
        'entry_id',
        'amount',
        'type',
        'status',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}
