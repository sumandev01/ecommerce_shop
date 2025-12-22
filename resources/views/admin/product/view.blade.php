@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title d-flex justify-content-between align-items-center pt-4">
                <h4 class="">Product Details</h4>
                <a href="{{ route('product.index') }}" class="btn btn-secondary btn-sm">
                    <i data-lucide="arrow-left" class="mr-2" style="width: 20px; height: 20px;"></i>
                    Back
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="sectionCard mb-5">
                <h4 class="sectionTitle mb-3">Product Information</h4>
                <div class="mb-3">
                    <h5 class="mb-1">Product Name:</h5>
                    <p>{{ $product->name }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="mb-1">Product Short Description:</h5>
                    <p>{{ $product->details?->short_description ?? 'N/A' }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="mb-1">Tags:</h5>
                    @forelse ($product->tags as $tag )
                        <p class="btn btn-sm btn-primary text-white">{{ $tag->name }}</p>
                    @empty
                        <span class="text-muted">N/A</span>
                    @endforelse
                </div>
            </div>
            <div class="sectionCard mb-5">
                <h4 class="sectionTitle">General Information</h4>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Category: <span class="text-muted">{{ $product->details->category?->name ?? 'N/A' }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Sub-Category: <span class="text-muted">{{ $product->details->subCategory?->name ?? 'N/A' }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Product SKU: <span class="text-muted">{{ $product->sku_code ?? 'N/A' }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Brand: <span class="text-muted">{{ $product->details->brand?->name ?? 'N/A' }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Buy Price: <span class="text-muted">{{ $product->buy_price ?? 'N/A' }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Selling Price: <span class="text-muted">{{ $product->price ?? 'N/A' }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Discount Price: <span class="text-muted">{{ $product->discount_price ?? 'N/A' }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Quantity: <span class="text-muted">{{ $product->stock ?? 'N/A' }}</span></h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-3">Status:
                            @if ($product->status == 1)
                                <span class="text-success">Active</span>
                            @else
                                <span class="text-danger">Inactive</span>
                            @endif
                        </h5>
                    </div>
                </div>
            </div>
            <div class="sectionCard mb-5">
                <h4 class="sectionTitle">Product Description</h4>
                <div class="mb-3">
                    <h5 class="mb-1">Description:</h5>
                    <p>{!! $product->details?->long_description ?? 'N/A' !!}</p>
                </div>
                <div class="mb-3">
                    <h5 class="mb-1">Additional Information:</h5>
                    <p>{!! $product->details?->additional_info ?? 'N/A' !!}</p>
                </div>
            </div>
            <div class="sectionCard mb-5">
                <h4 class="sectionTitle">Product Images</h4>
                <div class="mb-3">
                    <h5 class="mb-3">Product Thumbnail:</h5>
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-6 mb-3">
                            <img src="{{ asset($product->thambnail) }}" alt="" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="">
                    <h5 class="mb-3">Product Gallery:</h5>
                    <div class="row">
                    @forelse($product->galleries as $media)
                        <div class="col-lg-2 col-md-3 col-sm-6 mb-3">
                            <img src="{{ Storage::url($media->src) }}" alt="" class="w-100">
                        </div>
                        @empty
                        <p class="text-muted">No images available for this product.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm"><i data-lucide="edit" class="mr-2" style="width: 20px; height: 20px;">></i> Edit</a>
            </div>
        </div>
@endsection