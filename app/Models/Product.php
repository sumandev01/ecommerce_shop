<?php

namespace App\Models;
use App\Models\Media;
use App\Models\ProductDetails;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasOne(ProductDetails::class);
    }

    public function galleries()
    {
        return $this->belongsToMany(Media::class, 'product_galleries', 'product_id', 'media_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_inventories', 'product_id', 'color_id')->distinct();
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_inventories', 'product_id', 'size_id')->distinct();
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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $baseSlug = Str::slug($product->name);
                $slug = $baseSlug;
                $count = 1;
                while (Product::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }
                $product->slug = $slug;
            } else {
                $product->slug = Str::slug($product->slug);
            }
        });
    }

    /**
     * Format a given amount in Bangladeshi Taka (BDT) using commas as thousand separators.
     * 
     * @param int $amount The amount to be formatted.
     * 
     * @return string The formatted amount.
     */
    public function formatBD($amount)
    {
        if (!$amount || $amount == 0) return 0;
        
        $amount = round($amount);

        $lastThree = substr($amount, -3);
        $restUnits = substr($amount, 0, -3);

        if ($restUnits != '') {
            $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ',', $restUnits);
            $formatted = $restUnits . ',' . $lastThree;
        } else {
            $formatted = $lastThree;
        }

        return $formatted;
    }
}
