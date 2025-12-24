<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Judge extends Model
{
    protected $fillable = [
        'name',
        'avatar',
        'location',
        'bio',
        'expertise_skills',
        'scoring_philosophy',
        'is_active'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(JudgeTag::class, 'judge_judge_tag')
            ->withTimestamps();
    }

    public function credentials(): HasMany
    {
        return $this->hasMany(JudgingCredential::class)
            ->orderBy('order');
    }

    public function competitions(): HasMany
    {
        return $this->hasMany(CompetitionsJudged::class)
            ->orderBy('order');
    }

    public function currentCompetitions()
    {
        return $this->competitions()->where('type', 'current')->orderBy('order');
    }

    public function previousCompetitions()
    {
        return $this->competitions()->where('type', 'previous')->orderBy('order');
    }
}
