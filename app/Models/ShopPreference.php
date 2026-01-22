<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShopPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'default_payment_method_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
