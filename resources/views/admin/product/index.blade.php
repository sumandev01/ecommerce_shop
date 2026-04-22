@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header display-flex justify-content-between align-items-center bg-light">
            <div class="card-title d-flex justify-content-between align-items-center py-4 mb-0">
                <h5 class="">All Products</h5>
                <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">
                    <x-lucide-plus class="me-1" style="width: 18px;" />
                    Add Product
                </a>
            </div>
        </div>
        <div class="card-body">
            <div>
                <table class="table table-bordered table-hover table-striped" id="productTable">
                    <thead>
                        <tr>
                            <th class="text-left" scope="col">SL</th>
                            <th style="max-width: 150px;" scope="col">Name</th>
                            <th scope="col">Category / sub category</th>
                            <th scope="col">Brand</th>
                            <th style="min-width: 120px" scope="col">Price</th>
                            <th class="text-center" scope="col">Status</th>
                            <th style="min-width: 150px;" class="text-right" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products ?? [] as $key => $product)
                            <tr>
                                <td class="text-left">{{ $key + 1 }}</td>
                                <td class="d-flex align-items-center">
                                    <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="rounded-0 me-2" style="aspect-ratio: 1/1" width="100">
                                    <span>{{ $product->name }}</span>
                                </td>
                                <td>
                                    <span>{{ $product->details?->category?->name ?? 'N/A' }}</span>
                                    <br>
                                    <span class="text-muted">{{ $product->details?->subCategory?->name ?? 'N/A' }}</span>
                                </td>
                                <td>{{ $product->details?->brand?->name ?? 'N/A' }}</td>
                                <td>৳{{ formatBD($product->price, 2) }}</td>
                                <td class="text-center">
                                    @if ($product->status == 1)
                                        <span class="badge badge-success py-2">Active</span>
                                    @else
                                        <span class="badge badge-danger py-2">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('product.inventory', $product->id) }}" class="btn btn-md btn-success btn-icon"><x-lucide-package /></a>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-md btn-warning btn-icon"><x-lucide-edit /></a>
                                    <a href="{{ route('product.view', $product->id) }}" class="btn btn-md btn-info btn-icon"><x-lucide-eye /></a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Product Found</td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();
        });
    </script>
@endpush