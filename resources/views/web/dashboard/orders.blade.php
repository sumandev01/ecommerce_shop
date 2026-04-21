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
                        <div class="container-fluid p-4">
                                <h5 class="mb-3 fw-bold">My order list</h5>
                            <div class="table-responsive">
                                <table class="table table-hover pb-0">
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
                                                <a href="{{ route('order-details', $order?->id) }}" class="btn btn-info btn-icon btn-sm">View</a>
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
    </section>
    <!-- end wpo-dashboard-section -->
@endsection
