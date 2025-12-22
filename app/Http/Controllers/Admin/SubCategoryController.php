<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Repositories\SubCategoryRepository;
use App\Repositories\SubCategoryRepositoryEloquent;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    protected $SubCategoryRepo;
    public function __construct(SubCategoryRepository $SubCategoryRepo)
    {
        $this->SubCategoryRepo = $SubCategoryRepo;
    }
    public function index()
    {
        $categories = Category::latest('id')-> get();
        $subCategories = SubCategory::latest('id')-> get();
        return view('admin.SubCategory.index', compact('categories', 'subCategories'));
    }

    public function store(SubCategoryRequest $request)
    {
        // Validation and storing logic will go here

        $subCategory = $this->SubCategoryRepo->storeByRequest($request);
        if ($subCategory) {
            return to_route('subcategory.index')->with('success', 'SubCategory created successfully.');
        } else {
            return to_route('subcategory.index')->with('error', 'Failed to create SubCategory.');
        }
    }

    public function edit(SubCategory $subcategory)
    {
        $categories = Category::latest('id')-> get();
        return view('admin.SubCategory.edit', compact('subcategory', 'categories'));
    }

    public function update(SubCategoryRequest $request, SubCategory $subcategory)
    {
        $updated = $this->SubCategoryRepo->updateByRequest($request, $subcategory);
        if ($updated) {
            return to_route('subcategory.index')->with('success', 'SubCategory updated successfully.');
        } else {
            return to_route('subcategory.index')->with('error', 'Failed to update SubCategory.');
        }
    }

    public function destroy(SubCategory $subcategory)
    {
        $deleted = $this->SubCategoryRepo->delete($subcategory);

        if ($deleted) {
            return to_route('subcategory.index')->with('success', 'SubCategory deleted successfully.');
        } else {
            return to_route('subcategory.index')->with('error', 'Failed to delete SubCategory.');
        }
    }
}
