<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JudgingCredential extends Model
{
    protected $fillable = ['judge_id', 'title', 'value', 'order'];

    protected $table = 'judging_credentials';

    public function judge()
    {
        return $this->belongsTo(Judge::class);
    }
}
