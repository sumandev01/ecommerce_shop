@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">View Product</h4>
                            <a href="{{ route('product.index') }}" class="btn btn-secondary">
                                <i data-lucide="arrow-left" class="me-1" style="width: 18px;"></i> Back to Products
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">
                            <strong>Note:</strong> This page displays the full details of a specific product.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <!-- Main Card -->
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <h4 class="card-title mb-0">Product Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h5 class="mb-1">Name:</h5>
                            <p>{{ $product->name }}</p>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">Slug:</h5>
                            <p>{{ $product->slug }}</p>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">Short Description:</h5>
                            <p>{!! $product->details?->short_description ?? 'N/A' !!}</p>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">Tags:</h5>
                            <p>{{ $tags->pluck('name')->implode(', ') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <h4 class="card-title mb-0">Full Description</h4>
                    </div>
                    <div class="card-body">
                        <p>{!! $product->details?->long_description ?? 'N/A' !!}
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <h4 class="card-title mb-0">Additional Information</h4>
                    </div>
                    <div class="card-body">
                        {!! $product->details?->additional_info ?? 'N/A' !!}
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <h4 class="card-title mb-0">Product Gallery</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($product->galleries as $media)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                    <div class="ratio ratio-1x1">
                                        <img src="{{ Storage::url($media->src) }}" alt="" class="w-100">
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No images available for this product.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Product Inventory</h4>
                            <a href="{{ route('product.inventory', $product->id) }}" class="btn btn-secondary">
                                <i data-lucide="settings" class="me-1" style="width: 18px;"></i> Manage
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-striped" id="inventoryTable">
                            <thead>
                                <tr>
                                    <th class="text-start">Sl</th>
                                    <th class="text-center">Color</th>
                                    <th class="text-center">Size</th>
                                    <th class="text-center">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($inventories ?? [] as $key => $inventory)
                                    <tr>
                                        <td class="text-start ps-2">{{ $key + 1 }}</td>
                                        <td class="text-center">
                                            <div
                                                style="width: 30px; height: 30px; background-color: {{ $inventory?->color?->hex_code }}; border-radius: 50%; margin: 0 auto; border: 1px solid #000">
                                            </div>
                                        </td>
                                        <td class="text-center"> {{ $inventory?->size?->name }} </td>
                                        <td class="text-center">{{ $inventory?->quantity }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No Product Inventory Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <h4 class="card-title mb-0">Pricing & Inventory</h4>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <h5 class="mb-1">Buy Price: <span class="text-muted">&#2547;{{ $product?->buy_price ?? 'N/A' }}</span></h5>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">Selling Price: <span class="text-muted">&#2547;{{ $product?->price ?? 'N/A' }}</span></h5>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">Discounted Price:
                                <span class="text-muted">&#2547;{{ $product?->discount_price ?? 'N/A' }}</span></h5>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">SKU: <span class="text-muted">{{ $product?->sku_code ?? 'N/A' }}</span></h5>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">Quantity:
                                @if ($product->stock > 0)
                                    <span class="text-success">{{ $product->stock ?? 'N/A' }} Items</span>
                                @else
                                    <span class="text-danger">Out of Stock</span>
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <h4 class="card-title mb-0">Organization</h4>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <h5 class="mb-1">Category: <span class="text-muted">{{ $product->details->category?->name ?? 'N/A' }}</span></h5>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">Sub Category: <span class="text-muted">{{ $product->details->subCategory?->name ?? 'N/A' }}</span></h5>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">Brand: <span class="text-muted">{{ $product->details->brand->name ?? 'N/A' }}</span></h5>
                        </div>

                        <div class="mb-3">
                            <h5 class="mb-1">Status: 
                                @if ($product->status == 1)
                                    <span class="text-success">Active</span>
                                @elseif ($product->status == 0)
                                    <span class="text-danger">Inactive</span>
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header py-4 bg-light">
                        <h4 class="card-title mb-0">Thumbnail</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset($product->thumbnail) }}" alt=""
                                style="max-width:80%; max-height:80%; object-fit:contain;">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center">

                        <button type="button" onclick="window.location.href='{{ route('product.edit', $product->id) }}'"
                            class="btn btn-primary px-5">
                            <i data-lucide="edit" class="ms-1" style="width: 18px;"></i>
                            <span>Edit Product</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#inventoryTable').DataTable();
        });
    </script>
@endpush
