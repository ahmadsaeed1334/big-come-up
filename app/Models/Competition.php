<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'short_description',
        'cover_image',
        'submission_type',
        'video_duration_limit',
        'eligibility',
        'entry_fee_type',
        'entry_fee_amount',
        'start_at',
        'end_at',
        'voting_start_at',
        'voting_end_at',
        'judge_score_weight',
        'public_votes_weight',
        'fraud_protection',
        'prize_title',
        'prize_amount',
        'prize_description',
        'is_published'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'voting_start_at' => 'datetime',
        'voting_end_at' => 'datetime',
        'entry_fee_amount' => 'decimal:2',
        'prize_amount' => 'decimal:2',
        'is_published' => 'boolean',
        'fraud_protection' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(CompetitionCategory::class, 'category_id', 'id');
    }

    public function criteria()
    {
        // ✅ Explicitly define the foreign key and table
        return $this->hasMany(CompetitionCriteria::class, 'competition_id', 'id');
    }
}
