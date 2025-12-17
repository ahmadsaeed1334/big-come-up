<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'start_date',
        'end_date',
        'entry_fee',
        'rules'
    ];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'entry_fee' => 'decimal:2',
    ];
}
