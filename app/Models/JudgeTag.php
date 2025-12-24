<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JudgeTag extends Model
{
    protected $fillable = ['name'];

    public function judges(): BelongsToMany
    {
        return $this->belongsToMany(Judge::class, 'judge_judge_tag')
            ->withTimestamps();
    }
}
