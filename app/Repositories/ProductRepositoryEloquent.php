<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Tag;
use App\Repositories\MediaRepositoryEloquent;
use App\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function storeByRequest($request) {
        $thambnail = null;
        if ($request->hasFile('thambnail')) {
            $thambnail = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('thambnail'), 'products', 'thambnail');
        }

        $product = self::create([
            'name' => $request->name,
            'sku_code' => $request->product_sku,
            'price' => $request->sell_Price,
            'buy_price' => $request->buy_Price,
            'discount_price' => 0,
            'media_id' => $thambnail->id,
        ]);

        $productDetails = ProductDetails::create([
            'product_id' => $product->id,
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'brand_id' => $request->brand,
            'short_description' => $request->shortDescription,
            'long_description' => $request->description,
            'additional_info' => $request->additional_info,
        ]);

        if ($request->has('tag')) {
            $tagIds = [];
            foreach ($request->tag as $tagValue) {
                if (is_numeric($tagValue)) {
                    $tagIds[] = $tagValue;
                } else {
                    $newTag = Tag::firstOrCreate([
                        'name' => $tagValue
                    ]);
                    $tagIds[] = $newTag->id;
                }
            }
            if ($tagIds > 0) {
                $product->tags()->attach($tagIds);
            }
        }

        $images = $request->file('images');
        $mediaIds = [];
        if ($images) {
            foreach ($images as $image) {
                $media = app(MediaRepositoryEloquent::class)->storeByRequest($image, 'products', 'image');
                $mediaIds[] = $media->id;
            }
        };

        if ($mediaIds > 0) {
            $product->galleries()->attach($mediaIds);
        }

        return $product;
    }

    public function updateByRequest($request, Product $product) {

        $media = $product->media->id;
        if ($request->hasFile('thambnail')) {
            $thambnail = app(MediaRepositoryEloquent::class)->updateByRequest($request->file('thambnail'), 'products', 'thambnail', $product->media);
        }

        $product->update([
            'name' => $request->name,
            'sku_code' => $request->product_sku,
            'price' => $request->sell_Price,
            'buy_price' => $request->buy_Price,
            'discount_price' => $request->discount_Price,
            'media_id' => $thambnail->id ?? $media,
        ]);

        $productDetails = ProductDetails::where('product_id', $product->id)->update([
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'brand_id' => $request->brand,
            'short_description' => $request->shortDescription,
            'long_description' => $request->description,
            'additional_info' => $request->additional_info,
        ]);

        if ($request->has('deleted_images') && is_array($request->deleted_images)) {
            foreach ($request->deleted_images as $mediaIds) {
                app(MediaRepositoryEloquent::class)->deleteMediaId($mediaIds);
            }
        }

        $images = $request->file('images');
        $mediaIds = [];
        if ($images) {
            foreach ($images as $image) {
                $media = app(MediaRepositoryEloquent::class)->storeByRequest($image, 'products', 'image');
                $mediaIds[] = $media->id;
            }
        };
        if ($mediaIds > 0) {
            $product->galleries()->attach($mediaIds);
        }

        return $product;
    }
    
}
