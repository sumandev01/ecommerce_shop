@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header display-flex justify-content-between align-items-center bg-light">
            <div class="card-title d-flex justify-content-between align-items-center py-4 mb-0">
                <h5 class="">All Orders</h5>
            </div>
        </div>
        <div class="card-body">
            <div>
                <table class="table table-bordered table-hover table-striped" id="productTable">
                    <thead>
                        <tr>
                            <th class="text-left" scope="col">Order ID</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Date</th>
                            <th class="text-center" scope="col">Status</th>
                            <th style="min-width: 150px;" class="text-right" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders ?? [] as $key => $order)
                            <tr>
                                <td class="text-left">{{ $order?->order_code }}</td>
                                <td>৳{{ formatBD($order?->total_price, 2) }}</td>
                                <td>{{ $order?->created_at->format('d M, Y') }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill bg-{{ $order?->status?->color() }}">
                                        {{ ucfirst($order?->status?->value) }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('product.edit', $order->id) }}"
                                        class="btn btn-md btn-warning btn-icon"><x-lucide-edit /></a>
                                    <a href="{{ route('admin.order.view', $order->id) }}"
                                        class="btn btn-md btn-info btn-icon"><x-lucide-eye /></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Order Found</td>
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
