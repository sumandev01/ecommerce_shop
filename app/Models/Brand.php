<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    protected $guarded = ['id'];

    /**
     * Returns the media associated with this brand.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media(){
        return $this->belongsTo(Media::class);
    }

    /**
     * Returns the thumbnail URL for the brand.
     * If the brand has a media file associated with it,
     * it will return the URL of the media file. Otherwise,
     * it will return the default thumbnail URL.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function thumbnail(): Attribute{
        $url = asset('default.webp');
        if($this->media && Storage::exists($this->media->src)){
            $url =  Storage::url($this->media->src);
        }
        return Attribute::make(
            get: fn () => $url,
        );
    }

    /**
     * Returns the alt text for the brand.
     * If the brand has a media file associated with it,
     * it will return the name of the media file. Otherwise,
     * it will return the name of the brand, or 'Brand Image'
     * if the brand has no name.
     *
     * @return string
     */
    public function alt(): Attribute{
        return Attribute::make(
            get: fn () => ($this->media && !empty($this->media->name))
                ? $this->media->name
                : ($this->name ?? 'Brand Image')
        );
    }

    /**
     * Boot the model.
     *
     * When creating a new brand, set the slug to a unique value if it is not provided.
     * If the slug is provided, convert it to a slug using the Str::slug function.
     * If the slug already exists, append a number to the end of the slug
     * to make it unique.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand) {
            if (empty($brand->slug)) {
                $baseSlug = Str::slug($brand->name);
                $slug = $baseSlug;
                $count = 1;
                while (Brand::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                $brand->slug = $slug;
            } else {
                $brand->slug = Str::slug($brand->slug);
            }
        });
    }
}
