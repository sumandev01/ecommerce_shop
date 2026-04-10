@extends('web.layouts.app')
@section('content')
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <h2 class="d-none">Hide</h2>
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="{{ route('root') }}">Home</a></li>
                            <li><a href="{{ route('shop') }}">Product Page</a></li>
                            <li>Cart</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- cart-area-s2 start -->
    <div class="cart-area-s2 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-page-title">
                        <h2>Your Cart</h2>
                        <p>There are {{ $cartItemsCount }} products in this list</p>
                    </div>
                </div>
            </div>
            <div class="cart-wrapper">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <form action="#">
                            <div class="cart-item">
                                <table class="table-responsive cart-wrap">
                                    <thead>
                                        <tr>
                                            <th class="images images-b">Product</th>
                                            <th class="ptice">Price</th>
                                            <th class="stock">Quantity</th>
                                            <th class="ptice total">Subtotal</th>
                                            <th class="remove remove-b">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cartItems ?? [] as $cartItem)
                                            @php
                                                $price =
                                                    $cartItem?->product?->discount_price > 0
                                                        ? $cartItem?->product?->discount_price
                                                        : $cartItem?->product?->price;
                                                $subTotal = $price * $cartItem?->quantity;
                                            @endphp
                                            <tr class="wishlist-item" data-cart-id="{{ $cartItem?->id }}">
                                                <td class="product-item-wish">
                                                    <div class="check-box"><input type="checkbox"
                                                            class="myproject-checkbox">
                                                    </div>
                                                    <div class="images">
                                                        <span>
                                                            <img src="{{ $cartItem?->product?->thumbnail }}"
                                                                style="object-fit: contain; aspect-ratio: 1/1"
                                                                alt="{{ $cartItem?->product?->name }}">
                                                        </span>
                                                    </div>
                                                    <div class="product">
                                                        <ul>
                                                            <li class="first-cart">
                                                                {{ Str::limit($cartItem?->product?->name, '20', '..') }}
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <i class="fi flaticon-star"></i>
                                                                    <i class="fi flaticon-star"></i>
                                                                    <i class="fi flaticon-star"></i>
                                                                    <i class="fi flaticon-star"></i>
                                                                    <i class="fi flaticon-star"></i>
                                                                    <span>130</span>
                                                                </div>
                                                            </li>
                                                            <li class="d-flex gap-2">
                                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                                    @if ($cartItem?->size)
                                                                        <span>Size:
                                                                            <strong>{{ $cartItem?->size?->name }}</strong></span>
                                                                    @endif
                                                                    @if ($cartItem?->size && $cartItem?->color)
                                                                        <span class="text-muted">|</span>
                                                                    @endif
                                                                    @if ($cartItem?->color)
                                                                        <div class="d-flex gap-1 align-items-center">
                                                                            <span>Color:</span>
                                                                            <span
                                                                                style="background-color: {{ $cartItem?->color?->hex_code }}; width: 15px; height: 15px; display: inline-block; border-radius: 50%; border: 1px solid #eee;">
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td class="ptice">৳{{ formatBD($price) }}</td>
                                                <td class="td-quantity">
                                                    <div class="quantity cart-plus-minus"
                                                        data-product-id="{{ $cartItem?->product?->id }}"
                                                        data-product-price="{{ $price }}">
                                                        <input class="text-value quantity-input" type="text"
                                                            value="{{ $cartItem?->quantity }}">
                                                        <div class="dec qtybutton">-</div>
                                                        <div class="inc qtybutton">+</div>
                                                    </div>
                                                </td>
                                                <td class="ptice subtotal-cell">
                                                    ৳{{ formatBD($subTotal) }}</td>
                                                <td class="action">
                                                    <ul>
                                                        <li class="w-btn">
                                                            <a class="remove-btn" data-bs-toggle="tooltip"
                                                                data-bs-html="true" title=""
                                                                href="{{ route('cart.destroy', $cartItem?->id) }}"
                                                                data-bs-original-title="Remove from Cart"
                                                                aria-label="Remove from Cart">
                                                                <i class="fi ti-trash"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="wishlist-item">
                                                <td colspan="7" class="text-center py-1 fs-4">No Product Found In Cart
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-action">
                                <div class="apply-area">
                                    <input type="text" class="form-control" id="couponInput"
                                        placeholder="Enter your coupon">
                                    <button type="button" class="theme-btn-s2" id="couponBtn">Apply</button>
                                </div>
                                <a class="theme-btn-s2" href="{{ route('cart') }}"><i class="fi flaticon-refresh"></i>
                                    Update
                                    Cart</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="cart-total-wrap">
                            <h3>Cart Totals</h3>
                            <div class="sub-total">
                                <h4>Subtotal</h4>
                                <span id="total_price">৳{{ formatBD($totalPrice) }}</span>
                            </div>
                            <div class="sub-total my-3">
                                <h4>Discount</h4>
                                <span id="total_discount">00.00</span>
                            </div>
                            <div class="total mb-3">
                                <h4>Total</h4>
                                <span id="grand_total">৳{{ formatBD($totalPrice) }}</span>
                            </div>
                            <form action="{{ route('checkout.index') }}" method="post">
                                @csrf
                                <input type="hidden" id="CouponId" name="coupon_id">
                                <button type="submit" class="theme-btn-s2 border-0" href="checkout.html">Proceed To
                                    CheckOut</butt>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-prodact">
                <h2>You May be Interested in…</h2>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="image">
                                <img src="assets/images/interest-product/1.png" alt="">
                                <div class="tag new">New</div>
                            </div>
                            <div class="text">
                                <h2><a href="product-single.html">Wireless Headphones</a></h2>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>130</span>
                                </div>
                                <div class="price">
                                    <span class="present-price">$120.00</span>
                                    <del class="old-price">$200.00</del>
                                </div>
                                <div class="shop-btn">
                                    <a class="theme-btn-s2" href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="image">
                                <img src="assets/images/interest-product/2.png" alt="">
                                <div class="tag sale">Sale</div>
                            </div>
                            <div class="text">
                                <h2><a href="product-single.html">Blue Bag with Lock</a></h2>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>120</span>
                                </div>
                                <div class="price">
                                    <span class="present-price">$160.00</span>
                                    <del class="old-price">$190.00</del>
                                </div>
                                <div class="shop-btn">
                                    <a class="theme-btn-s2" href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="image">
                                <img src="assets/images/interest-product/3.png" alt="">
                                <div class="tag new">New</div>
                            </div>
                            <div class="text">
                                <h2><a href="product-single.html">Stylish Pink Top</a></h2>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>150</span>
                                </div>
                                <div class="price">
                                    <span class="present-price">$150.00</span>
                                    <del class="old-price">$200.00</del>
                                </div>
                                <div class="shop-btn">
                                    <a class="theme-btn-s2" href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="product-item">
                            <div class="image">
                                <img src="assets/images/interest-product/4.png" alt="">
                                <div class="tag sale">Sale</div>
                            </div>
                            <div class="text">
                                <h2><a href="product-single.html">Brown Com Boots</a></h2>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>120</span>
                                </div>
                                <div class="price">
                                    <span class="present-price">$120.00</span>
                                    <del class="old-price">$150.00</del>
                                </div>
                                <div class="shop-btn">
                                    <a class="theme-btn-s2" href="product.html">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            // grand total
            function updateGrandTotal() {
                let total = 0;

                $(".subtotal-cell").each(function() {
                    let subtotalText = $(this).text().replace(/[^0-9.]/g, '');
                    total += parseFloat(subtotalText) || 0;
                });
                $("#total_price").text("৳" + total.toLocaleString('en-IN'));
                $("#grand_total").text("৳" + total.toLocaleString('en-IN'));
            }

            // quantity update
            $(".qtybutton").on("click", function() {
                const $button = $(this);
                const $container = $button.closest('.cart-plus-minus');
                const $row = $button.closest('tr');
                const $input = $container.find(".text-value");

                let quantity = parseInt($input.val()) || 1;
                const productPrice = Number($container.data('product-price'));

                if (quantity <= 1) {
                    quantity = 1;
                    $input.val(1);
                } else {
                    $input.val(quantity);
                }

                const subTotal = quantity * productPrice;
                const formattedSubtotal = subTotal.toLocaleString('en-IN');

                $row.find(".subtotal-cell").text("৳" + formattedSubtotal);

                updateGrandTotal();

                const cartId = $row.data('cart-id');
                $.ajax({
                    url: "{{ route('cart.update') }}",
                    method: "POST",
                    data: {
                        id: cartId,
                        quantity: quantity,
                        _token: "{{ csrf_token() }}",
                    },
                });
            });

            // coupon code apply
            $("#couponBtn").on("click", function() {
                const couponCode = $("#couponInput").val();
                const cartSubTotal = $("#total_price").text().replace(/[^0-9.]/g, '');
                if (couponCode == '' || couponCode == null || couponCode == undefined || couponCode.length <
                    5) return;

                $.ajax({
                    url: "{{ route('coupon.apply') }}",
                    method: "POST",
                    data: {
                        coupon_code: couponCode,
                        amount: cartSubTotal,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            showToast('success', response.message);
                            $('#grand_total').text("৳" + response.discountPrice.toLocaleString(
                                'en-IN'));
                            $('#total_discount').text("৳" + (cartSubTotal - response
                                .discountPrice).toLocaleString('en-IN'));
                            $('.cart-plus-minus .qtybutton').addClass('cursor-not-allowed').css(
                                'pointer-events', 'none');
                            $('.remove-btn').addClass('cursor-not-allowed').css(
                                'pointer-events', 'none');
                            $('.quantity-input').attr('readonly', true);
                            $('#couponInput').val('');
                            $('#CouponId').val(response.couponId);
                        } else {
                            showToast('error', response.message);
                        }
                    },
                    error: function(response) {
                        showToast('error', response.responseJSON.message);
                    }
                });
            })
        });
    </script>
@endpush
