<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use App\Repositories\BrandRepositoryEloquent;
use App\Models\Brand;

class BrandController extends Controller
{
    protected $brandRepo;
    public function __construct(BrandRepository $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }
    public function index()
    {
        $brands = Brand::latest('id')-> get();
        return view('admin.brand.index', compact('brands'));
    }

    public function store(BrandRequest $request)
    {
        $brand = $this->brandRepo->storeByRequest($request);

        if ($brand) {
            return to_route('brand.index')->with('success', 'Brand created successfully.');
        } else {
            return to_route('brand.index')->with('error', 'Failed to create Brand.');
        }
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $updated = $this->brandRepo->updateByRequest($request, $brand);

        if ($updated) {
            return to_route('brand.index')->with('success', 'Brand updated successfully.');
        } else {
            return to_route('brand.index')->with('error', 'Failed to update Brand.');
        }
    }

    public function destroy(Brand $brand)
    {
        $deleted = $this->brandRepo->delete($brand);

        if ($deleted) {
            return to_route('brand.index')->with('success', 'Brand deleted successfully.');
        } else {
            return to_route('brand.index')->with('error', 'Failed to delete Brand.');
        }
    }
}
