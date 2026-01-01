<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArtistsProduct extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $fillable = [
        'artists_category_id',
        'artist_id',
        'title',
        'slug',
        'price',
        'sale_price',
        'rating',
        'reviews_count',
        'description',
        'product_details',
        'is_featured',
        'is_active'
    ];

    // Add these accessors for easier media access
    protected $appends = ['main_image_url', 'main_image_thumb_url', 'has_main_image'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Register media collections
     */
    public function registerMediaCollections(): void
    {
        // Main product image collection
        $this->addMediaCollection('main_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(300)
                    ->height(300);

                $this->addMediaConversion('medium')
                    ->width(800)
                    ->height(800);
            });

        // Additional product images collection
        $this->addMediaCollection('product_images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')
                    ->width(200)
                    ->height(200);

                $this->addMediaConversion('gallery')
                    ->width(800)
                    ->height(600);
            });
    }

    /**
     * Get main image URL with fallback
     */
    public function getMainImageUrlAttribute()
    {
        $media = $this->getFirstMedia('main_image');
        return $media ? $media->getUrl() : null;
    }

    /**
     * Get main image thumbnail URL
     */
    public function getMainImageThumbUrlAttribute()
    {
        $media = $this->getFirstMedia('main_image');
        return $media ? $media->getUrl('thumb') : null;
    }

    /**
     * Check if main image exists
     */
    public function getHasMainImageAttribute()
    {
        return $this->getFirstMedia('main_image') !== null;
    }

    /**
     * Get all product images URLs
     */
    public function getProductImagesUrlsAttribute()
    {
        return $this->getMedia('product_images')->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->getUrl(),
                'thumb_url' => $media->getUrl('thumb'),
                'gallery_url' => $media->getUrl('gallery'),
                'order' => $media->order_column
            ];
        });
    }

    /**
     * Get product images with thumbnails
     */
    public function getProductImagesWithThumbs()
    {
        return $this->getMedia('product_images')->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->getUrl(),
                'thumb' => $media->getUrl('thumb'),
                'gallery' => $media->getUrl('gallery')
            ];
        });
    }

    public function category()
    {
        return $this->belongsTo(ArtistsCategory::class, 'artists_category_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    // Update relationships
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'artists_product_color');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'artists_product_size');
    }
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'artists_product_id');
    }
}
