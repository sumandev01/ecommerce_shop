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
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">

                                    <div class="text-center mt-4 btn-print">
                                        <button class="btn btn-warning px-4 fw-bold text-white" onclick="window.print()">
                                            🖨️ Print / Download PDF
                                        </button>
                                    </div>

                                    <div class="invoice-wrapper">
                                        <div class="invoice-header">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <div class="invoice-logo">
                                                        <h2>Themart</h2>
                                                        <p class="text-muted small mb-0">A Marketplace Initiative</p>
                                                        <p class="text-muted small">support@themart.com | +880 123 456 789
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-md-end">
                                                    <h1 class="h2 text-uppercase mb-1">Invoice</h1>
                                                    <p class="mb-0">#ORD-12345</p>
                                                    <p class="mb-2 text-muted">Date: 14 Apr 2026</p>
                                                    <span class="status-badge status-processing">Processing</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3 mb-4">
                                            <div class="col-md-4">
                                                <div class="info-box">
                                                    <h6>Bill To</h6>
                                                    <p class="mb-0"><strong>John Doe</strong></p>
                                                    <p class="mb-0 text-muted">john@example.com</p>
                                                    <p class="mb-0 text-muted">+880 1700 000000</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-box">
                                                    <h6>Ship To</h6>
                                                    <p class="mb-0 text-muted">House #12, Road #5, Dhanmondi</p>
                                                    <p class="mb-0 text-muted">Dhaka, Bangladesh</p>
                                                    <p class="mb-0 text-muted">1209</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="info-box">
                                                    <h6>Order Info</h6>
                                                    <p class="mb-0 text-muted small"><strong>Method:</strong> Cash on
                                                        Delivery</p>
                                                    <p class="mb-0 text-muted small"><strong>Payment:</strong> Pending</p>
                                                    <p class="mb-0 text-muted small"><strong>Transaction:</strong> N/A</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive mb-4">
                                            <table class="table table-hover align-middle">
                                                <thead>
                                                    <tr>
                                                        <th class="border-0">#</th>
                                                        <th class="border-0">Product</th>
                                                        <th class="border-0 text-center">Unit Price</th>
                                                        <th class="border-0 text-center">Qty</th>
                                                        <th class="border-0 text-end">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="https://via.placeholder.com/45"
                                                                    class="product-thumb" alt="Product">
                                                                <div>
                                                                    <span class="d-block fw-bold">Premium Wireless
                                                                        Headphone</span>
                                                                    <small class="text-muted">Variant: Black</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">৳1,500.00</td>
                                                        <td class="text-center">2</td>
                                                        <td class="text-end fw-bold">৳3,000.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="https://via.placeholder.com/45"
                                                                    class="product-thumb" alt="Product">
                                                                <div>
                                                                    <span class="d-block fw-bold">Smart Watch Series
                                                                        7</span>
                                                                    <small class="text-muted">Variant: Blue Strap</small>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">৳2,500.00</td>
                                                        <td class="text-center">1</td>
                                                        <td class="text-end fw-bold">৳2,500.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row justify-content-end">
                                            <div class="col-md-5 col-lg-4">
                                                <div class="totals-row">
                                                    <span>Subtotal</span>
                                                    <span>৳5,500.00</span>
                                                </div>
                                                <div class="totals-row text-danger">
                                                    <span>Discount</span>
                                                    <span>- ৳500.00</span>
                                                </div>
                                                <div class="totals-row">
                                                    <span>Shipping</span>
                                                    <span>৳60.00</span>
                                                </div>
                                                <div class="totals-row grand-total">
                                                    <span>Grand Total</span>
                                                    <span>৳5,060.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
