<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['name', 'code', 'is_active'];

    public function products()
    {
        return $this->belongsToMany(ArtistsProduct::class, 'artists_product_color');
    }
}
