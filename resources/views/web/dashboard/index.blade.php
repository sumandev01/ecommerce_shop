@extends('web.layouts.app')
@section('content')
    <!-- start wpo-dashboard-section -->
    <section class="wpo-dashboard-section py-5">
        <div class="container">
            <div class="row">
                <div class="col col-lg-3 col-md-4 col-sm-12 col-xs-12">
                    @include('web.dashboard.sidebar-menu')
                </div>
                <div class="col col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="wpo-dashboard-right">
                        <div class="container-fluid">
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm p-3 h-100">
                                        <div class="card-body">
                                            <p class="text-muted mb-1 fs-6">Total orders</p>
                                            <h2 class="fw-bold mb-1">12</h2>
                                            <small class="text-muted">Since joining</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm p-3 h-100">
                                        <div class="card-body">
                                            <p class="text-muted mb-1 fs-6">In transit</p>
                                            <h2 class="fw-bold mb-1">2</h2>
                                            <small class="text-muted">Currently shipping</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm p-3 h-100">
                                        <div class="card-body">
                                            <p class="text-muted mb-1 fs-6">Total spent</p>
                                            <h2 class="fw-bold mb-1">৳ 18,400</h2>
                                            <small class="text-muted">All time</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div
                                    class="card-header bg-white pt-4 px-4 d-flex justify-content-between align-items-center border-0">
                                    <h5 class="mb-0 fw-bold">Latest activity</h5>
                                    <a href="{{ route('user.orders') }}" class="text-success text-decoration-none small">View all →</a>
                                </div>
                                <div class="table-responsive p-4">
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Items</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders ?? [] as $key => $order)
                                                <tr>
                                                    <td class="fw-bold">{{ $key + 1 }}</td>
                                                    <td class="fw-bold">{{ $order?->order_code }}</td>
                                                    <td>{{ $order?->created_at->format('d M Y') }}</td>
                                                    <td>{{ $order?->order_products_count }} items</td>
                                                    <td>৳{{ formatBD($order?->total_price) }}</td>
                                                    <td>
                                                        <span class="badge rounded-pill bg-{{ $order?->status?->color() }}">
                                                            {{ ucfirst($order?->status?->value) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('order-details', $order?->id) }}"
                                                            class="btn btn-info btn-icon btn-sm">View</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No orders found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end wpo-dashboard-section -->
@endsection
@push('style')
    <style>
        .card {
            border-radius: 10px;
        }
    </style>
@endpush
