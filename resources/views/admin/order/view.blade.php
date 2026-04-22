@extends('admin.layouts.app')
@section('content')
    <style>
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 20px;
        }

        .order-header {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 5px solid #0d6efd;
        }

        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .table thead th {
            background-color: #f1f3f5;
            border-bottom: none;
        }

        .summary-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>

    <div class="container">
        <div class="order-header d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h4 class="mb-1">Order #ORD-1025</h4>
                <p class="text-muted mb-0">Placed on: 22 April, 2026</p>
            </div>
            <div class="text-md-end mt-3 mt-md-0">
                <span class="badge bg-primary px-3 py-2">Processing</span>
                <span class="badge bg-success px-3 py-2">Paid</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title fw-bold text-uppercase mb-3">Customer Details</h6>
                        <p class="mb-1"><strong>Name:</strong> Suman Dev</p>
                        <p class="mb-1"><strong>Email:</strong> suman@example.com</p>
                        <p class="mb-0"><strong>Phone:</strong> +880 1234567890</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title fw-bold text-uppercase mb-3">Shipping Address</h6>
                        <address class="mb-0 text-muted">
                            Suman Dev<br>
                            123 Sector, Uttara<br>
                            Dhaka, 1230<br>
                            Bangladesh
                        </address>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h6 class="card-title fw-bold text-uppercase mb-3">Billing Address</h6>
                        <address class="mb-0 text-muted">
                            Suman Dev<br>
                            Same as Shipping Address
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Product</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th class="text-end pe-4">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" class="product-img me-3" alt="Product">
                                        <div>
                                            <p class="mb-0 fw-bold">ICE PRIME PRO TWS EARBUDS</p>
                                            <small class="text-muted">Color: Black</small>
                                        </div>
                                    </div>
                                </td>
                                <td>৳1,700</td>
                                <td>1</td>
                                <td class="text-end pe-4">৳1,700</td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="https://via.placeholder.com/50" class="product-img me-3" alt="Product">
                                        <div>
                                            <p class="mb-0 fw-bold">Running Sneakers for Men</p>
                                            <small class="text-muted">Size: 42</small>
                                        </div>
                                    </div>
                                </td>
                                <td>৳4,200</td>
                                <td>1</td>
                                <td class="text-end pe-4">৳4,200</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-7">
                <div class="no-print">
                    <button class="btn btn-outline-primary me-2">Download Invoice</button>
                    <button class="btn btn-outline-danger me-2">Cancel Order</button>
                    <button class="btn btn-dark">Track Order</button>
                </div>
                <div class="mt-4 p-3 bg-light rounded">
                    <p class="mb-0"><strong>Payment Method:</strong> Cash on Delivery</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="summary-box shadow-sm">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>৳5,900</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-danger">
                        <span>Discount (COUPON10)</span>
                        <span>-৳200</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-muted">
                        <span>Shipping Fee</span>
                        <span>৳60</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-0 fw-bold fs-5">
                        <span>Grand Total</span>
                        <span class="text-primary">৳5,760</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
