<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SubCategoryRepository;
use App\Models\SubCategory;
use App\Repositories\MediaRepositoryEloquent;
use Illuminate\Support\Facades\Storage;
use App\Validators\SubCategoryValidator;

/**
 * Class SubCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SubCategoryRepositoryEloquent extends BaseRepository implements SubCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubCategory::class;
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
        $media = null;
        if ($request->hasFile('image')) {
            $media = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('image'), 'subCategories', 'image');
        }
        return self::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category,
            'media_id' => $media ? $media->id : null,
        ]);
    }

    public function updateByRequest($request, SubCategory $subcategory)
    {
        $media = $subcategory->media;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($subcategory->media) {
                $media = app(MediaRepositoryEloquent::class)->updateByRequest($request->file('image'), 'subCategories', 'image', $subcategory->media);
            }else{
                $media = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('image'), 'subCategories', 'image');
            }
        }
        return $subcategory->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category,
            'media_id' => $media ? $media->id : null,
        ]);        
    }

    public function delete($subcategory)
    {
        // Delete associated media if exists
        if ($subcategory->media) {
            app(MediaRepositoryEloquent::class)->delete($subcategory->media);
        }
        return $subcategory->delete();
    }    
}
