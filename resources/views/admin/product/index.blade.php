@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header display-flex justify-content-between align-items-center">
            <div class="card-title d-flex justify-content-between align-items-center pt-4">
                <h4 class="">All Products</h4>
                <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm">
                    <i data-lucide="plus" class="mr-2" style="width: 20px; height: 20px;"></i>
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
                                <td>{{ $product?->name }}</td>
                                <td>
                                    <span>{{ $product->details?->category?->name ?? 'N/A' }}</span>
                                    <br>
                                    <span class="text-muted">{{ $product->details?->subCategory?->name ?? 'N/A' }}</span>
                                </td>
                                <td>{{ $product->details?->brand?->name ?? 'N/A' }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td class="text-center">
                                    @if ($product->status == 1)
                                        <span class="badge badge-success py-2">Active</span>
                                    @else
                                        <span class="badge badge-danger py-2">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('product.inventory', $product->id) }}" class="btn btn-md btn-success btn-icon"><i data-lucide="package"></i></a>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-md btn-warning btn-icon"><i data-lucide="edit"></i></a>
                                    <a href="{{ route('product.view', $product->id) }}" class="btn btn-md btn-info btn-icon"><i data-lucide="eye"></i></a>
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