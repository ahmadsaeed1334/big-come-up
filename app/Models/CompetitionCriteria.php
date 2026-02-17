<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetitionCriteria extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * ✅ CRITICAL FIX: Explicitly define the table name
     * Table name in migration: competition_criteria (plural)
     */
    protected $table = 'competition_criteria';

    protected $fillable = [
        'competition_id',
        'name',
        'weight',
        'max_score',
        'description'
    ];

    protected $casts = [
        'weight' => 'integer',
        'max_score' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'id');
    }
}
