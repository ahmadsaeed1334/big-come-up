<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{
    protected $fillable = [
        'artists_product_id',
        'user_name',
        'rating',
        'title',
        'review'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(ArtistsProduct::class, 'artists_product_id')->withDefault([
            'name' => 'Deleted Product',
            'images' => collect([]) // Empty collection
        ]);
    }
}
