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

    public function storeByRequest($request)
    {
        $thumbnailMedia = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailMedia = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('thumbnail'), 'products', 'thumbnail');
        }

        $discount_Percentage = 0;
        if ($request->discounted_price > 0) {
            $discount_Percentage = round((($request->price - $request->discounted_price) / $request->price) * 100);
        }

        $product = self::create([
            'name' => $request->name,
            'sku_code' => $request->sku,
            'price' => $request->price,
            'buy_price' => $request->buy_price ?? 0,
            'discount_price' => $request->discounted_price ?? 0,
            'discount_persentage' => $discount_Percentage,
            'stock' => $request->stock_quantity,
            'media_id' => $thumbnailMedia ? $thumbnailMedia->id : null,
        ]);

        ProductDetails::create([
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

        $images = $request->file('product_images');
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

    public function updateByRequest($request, Product $product)
    {
        // dd($request->all(), $product->toArray());
        $media = $product->media_id;
        if ($request->hasFile('thumbnail')) {
            if($product->media){
                $thumbnailMedia = app(MediaRepositoryEloquent::class)->updateByRequest($request->file('thumbnail'), 'products', 'thumbnail', $product->media);
            }
            $thumbnailMedia = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('thumbnail'), 'products', 'thumbnail');
        }

        $discount_Percentage = 0;
        if ($request->discounted_price > 0) {
            $discount_Percentage = round((($request->price - $request->discounted_price) / $request->price) * 100);
        }

        $product->update([
            'name' => $request->name,
            'sku_code' => $request->sku,
            'price' => $request->price,
            'buy_price' => $request->buy_price ?? 0,
            'discount_price' => $request->discounted_price ?? 0,
            'discount_persentage' => $discount_Percentage,
            'stock' => $request->stock_quantity,
            'media_id' => $thumbnailMedia->id ?? $media,
            'status' => $request->status,
        ]);

        ProductDetails::updateOrCreate(
            ['product_id' => $product->id],
            [
                'product_id' => $product->id,
                'category_id' => $request->category,
                'sub_category_id' => $request->subCategory,
                'brand_id' => $request->brand,
                'short_description' => $request->shortDescription,
                'long_description' => $request->description,
                'additional_info' => $request->additional_info,
            ]
        );

        if($request->has('tag')) {
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
            $product->tags()->sync($tagIds);
        } else {
            $product->tags()->detach();
        }

        if ($request->filled('removed_product_images')) {
            // Convert the JSON string into a PHP array
            $removedIds = json_decode($request->removed_product_images, true);

            // Check if it is a valid array and not empty
            if (is_array($removedIds) && count($removedIds) > 0) {
                foreach ($removedIds as $mediaId) {
                    // Delete media using the ID
                    app(MediaRepositoryEloquent::class)->deleteMediaId($mediaId);
                }
            }
        }

        $images = $request->file('product_images');
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
