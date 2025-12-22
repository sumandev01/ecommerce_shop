<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\Brand;
use App\Models\Media;
use App\Models\ProductDetails;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepositoryEloquent;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepo;
    public function __construct(ProductRepositoryEloquent $productRepo) {
        $this->productRepo = $productRepo;
    }
    public function index() {
        $products = Product::latest('id')->get();
        $categories = Category::latest('id')-> get();
        $subCategories = SubCategory::latest('id')-> get();
        $brands = Brand::latest('id')-> get();
        $productDetails = ProductDetails::latest('id')->get();
        return view('admin.product.index', compact('products', 'categories', 'subCategories', 'brands', 'productDetails'));
    }

    public function create() {
        $categories = Category::latest('id')-> get();
        $subCategories = SubCategory::latest('id')-> get();
        $tags = Tag::latest('id')->get();
        $brands = Brand::latest('id')-> get();
        return view('admin.product.create', compact('categories', 'subCategories', 'tags', 'brands'));
    }

    public function store(ProductRequest $request) {
        $product = $this->productRepo->storeByRequest($request);
        return to_route('product.index')->with('success', 'Product created successfully.');
    }

    public function view(Product $product) {
        $products = Product::latest('id')->get();
        $categories = Category::latest('id')-> get();
        $subCategories = SubCategory::latest('id')-> get();
        $brands = Brand::latest('id')-> get();
        $productDetails = ProductDetails::latest('id')->get();
        $medias = Media::latest('id')->get();
        $product = Product::with('galleries')->findOrFail($product->id);
        $tags = Tag::latest('id')->get();
        return view('admin.product.view', compact('product', 'categories', 'subCategories', 'brands', 'productDetails', 'medias', 'tags'));
    }

    public function edit(Product $product) {
        $products = Product::latest('id')->get();
        $categories = Category::latest('id')-> get();
        $subCategories = SubCategory::latest('id')-> get();
        $brands = Brand::latest('id')-> get();
        $productDetails = ProductDetails::latest('id')->get();
        $medias = Media::latest('id')->get();
        $product = Product::with('galleries')->findOrFail($product->id);
        $tags = Tag::latest('id')->get();
        return view('admin.product.edit', compact('product', 'categories', 'subCategories', 'brands', 'productDetails', 'medias', 'tags'));
    }

    public function subCategories($category_id) {
        $subCategories = SubCategory::where('category_id', $category_id)->get(['id', 'name']);
        return response()->json($subCategories);
    }

    public function update(ProductRequest $request, Product $product) {
        $product = $this->productRepo->updateByRequest($request, $product);
        return to_route('product.index')->with('success', 'Product updated successfully.');
    }
}