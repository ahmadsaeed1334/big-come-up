<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionCriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'name',
        'weight',
        'description'
    ];

    protected $casts = [
        'weight' => 'integer'
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
