<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Artist extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'bio'];

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(150)
                    ->height(150)
                    ->optimize();

                $this->addMediaConversion('medium')
                    ->width(400)
                    ->height(400)
                    ->optimize();
            });
    }

    /**
     * Get profile image URL
     */
    public function getProfileImageUrlAttribute()
    {
        return $this->getFirstMediaUrl('profile_image', 'medium') ?: null;
    }

    /**
     * Get profile image thumbnail URL
     */
    public function getProfileImageThumbUrlAttribute()
    {
        return $this->getFirstMediaUrl('profile_image', 'thumb') ?: null;
    }

    public function products()
    {
        return $this->hasMany(ArtistsProduct::class);
    }
}
