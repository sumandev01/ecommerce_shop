<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoryRepository;
use App\Models\Category;
use App\Validators\CategoryValidator;
use App\Repositories\MediaRepositoryEloquent;
use Illuminate\Support\Facades\Storage;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    /**
     * Store a category by a request
     * 
     * This method will also store the category's image if a new image is provided in the request.
     * If the category already has an image and the new image is provided, the old image will be deleted.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Category
     */
    public function storeByRequest($request)
    {
        $media = null;
        if ($request->hasFile('image')) {
            $media = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('image'), 'categories', 'image');
        }
        return self::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'media_id' => $media ? $media->id : null,
        ]);
    }


    /**
     * Update a category by a request.
     *
     * This method will also update the category's image if a new image is provided in the request.
     * If the category already has an image and the new image is provided, the old image will be deleted.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return void
     */
    public function updateByRequest($request, Category $category)
    {
        $media = $category->media;
        if ($request->hasFile('image')){
            if ($category->media && Storage::exists($category?->media?->src)){
                $media = app(MediaRepositoryEloquent::class)->updateByRequest($request->file('image'), 'categories', 'image', $category->media);
            }else{
                $media = app(MediaRepositoryEloquent::class)->storeByRequest($request->file('image'), 'categories', 'image');
            }
        }
        return $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'media_id' => $media ? $media->id : null,
        ]);
    }
    
    public function delete($category)
    {
        // Delete associated media if exists
        if ($category->media) {
            app(MediaRepositoryEloquent::class)->delete($category->media);
        }
        return $category->delete();
    }
}
