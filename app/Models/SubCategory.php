<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Media;

class SubCategory extends Model
{
    protected $guarded = ['id'];

    public function media(){
        return $this->belongsTo(Media::class);
    }

    public function thumbnail(): Attribute{
        $url = asset('default.webp');
        if($this->media && Storage::exists($this->media->src)){
            $url =  Storage::url($this->media->src);
        }
        return Attribute::make(
            get: fn () => $url,
        );
    }
    public function alt(): Attribute{
        return Attribute::make(
            get: fn () => ($this->media && !empty($this->media->name))
                ? $this->media->name
                : ($this->name ?? 'Sub-Category Image')
        );
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subCategory) {
            if (empty($subCategory->slug)) {
                $baseSlug = Str::slug($subCategory->name);
                $slug = $baseSlug;
                $count = 1;
                while (SubCategory::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                $subCategory->slug = $slug;
            } else {
                $subCategory->slug = Str::slug($subCategory->slug);
            }
        });
    }
}
