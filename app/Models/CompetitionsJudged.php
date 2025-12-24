<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionsJudged extends Model
{
    protected $fillable = ['judge_id', 'title', 'type', 'year', 'order'];

    protected $table = 'competitions_judged';

    public function judge()
    {
        return $this->belongsTo(Judge::class);
    }
}
