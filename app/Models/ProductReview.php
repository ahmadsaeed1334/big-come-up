<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = [
        'artists_product_id',
        'user_name',
        'rating',
        'title',
        'review'
    ];

    public function product()
    {
        return $this->belongsTo(ArtistsProduct::class);
    }
}
