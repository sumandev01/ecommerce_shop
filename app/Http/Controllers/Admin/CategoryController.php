<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryEloquent;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = Category::latest('id')-> get();
        return view('admin.category.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $Category = $this->categoryRepo->storeByRequest($request);
        
        if ($Category) {
            return to_route('category.index') ->with('success', 'Category created successfully.');
        } else {
            return to_route('category.index') ->with('error', 'Failed to create Category.');
        }
    }
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {

        $updated = $this->categoryRepo->updateByRequest($request, $category);

        if ($updated) {
            return to_route('category.index')->with('success', 'Category updated successfully.');
        } else {
            return to_route('category.index')->with('error', 'Failed to update Category.');
        }
    }

    public function destroy(Category $category)
    {
        $deleted = $this->categoryRepo->delete($category);

        if ($deleted) {
            return to_route('category.index')->with('success', 'Category deleted successfully.');
        } else {
            return to_route('category.index')->with('error', 'Failed to delete Category.');
        }
    }

}
