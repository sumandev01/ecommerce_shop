<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $guarded = ['id'];

    /**
     * Returns the media associated with this category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media(){
        return $this->belongsTo(Media::class);
    }

    /**
     * Returns the thumbnail URL for the category.
     * If the category has a media file associated with it,
     * it will return the URL of the media file. Otherwise,
     * it will return the default thumbnail URL.
     *
     * @return string
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
     * Returns the alt text for the category.
     * If the category has a media file associated with it,
     * it will return the name of the media file. Otherwise,
     * it will return the name of the category, or 'Category Image'
     * if the category has no name.
     *
     * @return string
     */
    public function alt(): Attribute{
        return Attribute::make(
            get: fn () => ($this->media && !empty($this->media->name))
                ? $this->media->name
                : ($this->name ?? 'Category Image')
        );
    }

    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }

        /**
         * Boot the model.
         *
         * When creating a new category, set the slug to a unique value if it is not provided.
         * If the slug is provided, convert it to a slug using the Str::slug function.
         * If the slug already exists, append a number to the end of the slug
         * to make it unique.
         */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $baseSlug = Str::slug($category->name);
                $slug = $baseSlug;
                $count = 1;
                while (Category::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                $category->slug = $slug;
            } else {
                $category->slug = Str::slug($category->slug);
            }
        });
    }
}
