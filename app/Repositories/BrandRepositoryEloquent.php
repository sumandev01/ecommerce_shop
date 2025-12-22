<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BrandRepository;
use App\Models\Brand;
use App\Repositories\MediaRepositoryEloquent;
use App\Validators\BrandValidator;
use Illuminate\Support\Facades\Storage;

/**
 * Class BrandRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BrandRepositoryEloquent extends BaseRepository implements BrandRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Brand::class;
    }

    /**
     * Store a brand by a request
     * 
     * This method will also store the brand's image if a new image is provided in the request.
     * If the brand already has an image and the new image is provided, the old image will be deleted.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \App\Entities\Brand
     */
    public function storeByRequest($request)
    {
        $media = null;
        if ($request->hasFile('image')) {
            $media = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('image'), 'brands', 'image');
        }
        return self::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'media_id' => $media ? $media->id : null,
        ]);
    }

    /**
     * Update a brand by a request.
     * 
     * This method will also update the brand's image if a new image is provided in the request.
     * If the brand already has an image and the new image is provided, the old image will be deleted.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return void
     */
    public function updateByRequest($request, Brand $brand)
    {
        $media = $brand->media;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($brand->media && Storage::exists($brand->media->src)){
                $media = app(MediaRepositoryEloquent::class)->updateByRequest($request->file('image'), 'brands', 'image', $brand->media);
            }else{
                $media = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('image'), 'brands', 'image');
            }
        }

        return $brand->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'media_id' => $media ? $media->id : null,
        ]);
    }

    public function delete($brand)
    {
        // Delete associated media if exists
        if ($brand->media) {
            app(MediaRepositoryEloquent::class)->delete($brand->media);
        }
        return $brand->delete();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
