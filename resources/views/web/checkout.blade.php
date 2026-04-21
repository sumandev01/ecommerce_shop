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
                            <li><a href="{{ route('cart') }}">Cart</a></li>
                            <li>Checkout</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- wpo-checkout-area start-->
    <div class="wpo-checkout-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-page-title">
                        <h2>Your Checkout</h2>
                        <p>There are {{ $cartItems?->count() ?? 0 }} products in this list</p>
                    </div>
                </div>
            </div>
            <form action="{{ route('orders.store') }}" method="GET">
                @csrf
                <input type="hidden" name="couponId" value="{{ $coupon?->id }}">
                <div class="checkout-wrap">
                    <div class="row">
                        <div class="col-lg-8 col-12">
                            <div class="caupon-wrap s3">
                                <div class="biling-item">
                                    <div class="coupon coupon-3">
                                        <h2>Billing Address</h2>
                                    </div>
                                    <div class="billing-adress">
                                        <div class="contact-form form-style">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Name*" id="name" name="name"
                                                        value="{{ old('name') ?? $user?->name }}" required>
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <select name="country" id="Country" class="form-control" required>
                                                        <option disabled="" selected="">Country*</option>
                                                        <option value="united_state">United State</option>
                                                        <option value="bangladesh">Bangladesh</option>
                                                        <option value="india">India</option>
                                                        <option value="srilanka">Srilanka</option>
                                                        <option value="pakisthan">Pakisthan</option>
                                                        <option value="afgansthan">Afgansthan</option>
                                                    </select>
                                                    @error('country')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="City / Town*" id="City"
                                                        name="city" value="{{ old('city') ?? $user?->city }}" required>
                                                    @error('city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Postcode / ZIP*" id="Post2"
                                                        name="postcode" value="{{ old('postcode') ?? $user?->postcode }}" required>
                                                    @error('postcode')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Company Name*" id="Company"
                                                        name="company" value="{{ old('company') ?? $user?->company }}">
                                                    @error('company')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="email" placeholder="Email Address*" id="email"
                                                        name="email" value="{{ old('email') ?? $user?->email }}" required>
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-12">
                                                    <input type="text" placeholder="Phone*" id="phone" name="phone"
                                                        value="{{ old('phone') ?? $user?->phone }}" required>
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <input type="text" placeholder="Address*" id="address"
                                                        name="address" value="{{ old('address') ?? $user?->address }}" required>
                                                    @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-12">
                                                    <div class="note-area mt-3">
                                                        <textarea name="message" placeholder="Additional Information">{{ old('message') ?? $user?->message }}</textarea>
                                                        @error('message')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="biling-item-3">
                                        <input id="toggle4" type="checkbox" name="differentAddress" value="1">
                                        <label class="fontsize" for="toggle4">Ship to a Different Address?</label>
                                        <div class="billing-adress" id="open4">
                                            <div class="contact-form form-style">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <input type="text" placeholder="Name*" id="shippingName"
                                                            name="shippingName" value="{{ old('shippingName') }}">
                                                        @error('shippingName')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <select name="shippingCountry" id="shippingCountry"
                                                            class="form-control">
                                                            <option disabled="" selected="">Country*</option>
                                                            <option value="united_state">United State</option>
                                                            <option value="bangladesh">Bangladesh</option>
                                                            <option value="india">India</option>
                                                            <option value="srilanka">Srilanka</option>
                                                            <option value="pakisthan">Pakisthan</option>
                                                            <option value="afgansthan">Afgansthan</option>
                                                        </select>
                                                        @error('shippingCountry')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <input type="text" placeholder="City / Town*" id="shippingCity"
                                                            name="shippingCity" value="{{ old('shippingCity') }}">
                                                        @error('shippingCity')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <input type="text" placeholder="Postcode / ZIP*"
                                                            id="shippingPost" name="shippingPost"
                                                            value="{{ old('shippingPost') }}">
                                                        @error('shippingPost')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <input type="text" placeholder="Company Name*" id="shippingCompany"
                                                            name="shippingCompany" value="{{ old('shippingCompany') }}">
                                                        @error('shippingCompany')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <input type="text" placeholder="Email Address*" id="shippingEmail"
                                                            name="shippingEmail" value="{{ old('shippingEmail') }}">
                                                        @error('shippingEmail')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-12">
                                                        <input type="text" placeholder="Phone*" id="shippingPhone"
                                                            name="shippingPhone" value="{{ old('shippingPhone') }}">
                                                        @error('shippingPhone')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-12">
                                                        <input type="text" placeholder="Address*" id="shippingAddress"
                                                            name="shippingAddress" value="{{ old('shippingAddress') }}">
                                                        @error('shippingAddress')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="cout-order-area">
                                <h3>Your Order</h3>
                                <div class="oreder-item">
                                    <div class="title">
                                        <h2>Products <span>Subtotal</span></h2>
                                    </div>
                                    @foreach ($cartItems ?? [] as $item)
                                        @php
                                            $productPrice =
                                                $item?->product?->discount_price > 0
                                                    ? $item?->product?->discount_price
                                                    : $item?->product?->price;
                                            $productSubTotal = $item?->quantity * $productPrice;
                                        @endphp
                                        <div class="oreder-product">
                                            <div class="d-flex align-items-start">
                                                <div class="images">
                                                    <span>
                                                        <img src="{{ $item?->product?->thumbnail }}"
                                                            style="object-fit: contain; aspect-ratio: 1/1" alt="">
                                                    </span>
                                                </div>
                                                <div class="product ms-2">
                                                    <ul>
                                                        <li class="first-cart" title="{{ $item?->product?->name }}">
                                                            {{ Str::limit($item?->product?->name, '10', '..') }}(x{{ $item?->quantity }})
                                                        </li>
                                                        <li>
                                                            <div class="rating-product">
                                                                <i class="fi flaticon-star"></i>
                                                                <i class="fi flaticon-star"></i>
                                                                <i class="fi flaticon-star"></i>
                                                                <i class="fi flaticon-star"></i>
                                                                <i class="fi flaticon-star"></i>
                                                                <span>15</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span>৳{{ formatBD($productSubTotal) }}</span>
                                        </div>
                                    @endforeach
                                    <div class="oreder-product">
                                        <div class="product">
                                            <ul>
                                                <li class="first-cart">Sub Total:</li>
                                            </ul>
                                        </div>
                                        <span>৳{{ formatBD($subTotal) }}</span>
                                    </div>
                                    <!-- Discount -->
                                    <div class="oreder-product">
                                        <div class="product">
                                            <ul>
                                                <li class="first-cart">Discount:</li>
                                            </ul>
                                        </div>
                                        <span>৳{{ formatBD($couponDiscount) ?? 0 }}</span>
                                    </div>
                                    <!-- Shipping -->
                                    <div class="mt-3 mb-3">
                                        <div class="title border-0">
                                            <h2>Delivery Charge</h2>
                                        </div>
                                        <ul>
                                            <li class="free">
                                                <input id="Free" type="radio" name="charge" value="60"
                                                    checked>
                                                <label for="Free">Inside Dhaka: ৳<span
                                                        class="charge">60.00</span></label>
                                            </li>
                                            <li class="free">
                                                <input id="Local" type="radio" name="charge" value="120">
                                                <label for="Local">Outside Dhaka: ৳<span
                                                        class="charge">120.00</span></label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="title s2">
                                        <h2>Total<span>৳<span
                                                    id="grand_total">{{ formatBD($grandTotal) ?? 0 }}</span></span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="caupon-wrap s5">
                                <div class="payment-area">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="payment-option" id="open5">
                                                <h3>Payment</h3>
                                                <div class="payment-select">
                                                    <ul>
                                                        <li class="">
                                                            <input id="remove" type="radio" name="payment_method"
                                                                value="cashOnDelivery">
                                                            <label for="remove">Cash on Delivery</label>
                                                        </li>
                                                        <li class="">
                                                            <input id="add" type="radio" name="payment_method"
                                                                checked="checked" value="ssl">
                                                            <label for="add">Pay With SSLCOMMERZ</label>
                                                        </li>
                                                        <li class="">
                                                            <input id="getway" type="radio" name="payment_method"
                                                                value="stripe">
                                                            <label for="getway">Pay With STRIPE</label>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div id="open6" class="payment-name active">
                                                    <div class="contact-form form-style">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-12">
                                                                <div class="submit-btn-area text-center">
                                                                    <button class="theme-btn" type="submit">Place
                                                                        Order</button>
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
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- wpo-checkout-area end-->
@endsection
@push('script')
    <script>
        let selectedValue = document.querySelector('input[name="charge"]:checked').value;
        let total = {{ $grandTotal ?? 0 }};

        let grandTotal = parseFloat(total) + parseFloat(selectedValue);
        document.getElementById('grand_total').textContent = grandTotal.toLocaleString('en-IN');
        document.querySelectorAll('input[name="charge"]').forEach((radio) => {
            radio.addEventListener('change', (event) => {
                selectedValue = event.target.value;
                grandTotal = parseFloat(total) + parseFloat(selectedValue);
                document.getElementById('grand_total').textContent = grandTotal.toLocaleString('en-IN');
            });
        });

        document.getElementById('toggle4').addEventListener('change', function() {
            const inputIds = ['shippingName', 'shippingCountry', 'shippingCity', 'shippingPost', 'shippingEmail', 'shippingPhone', 'shippingAddress'];
            const isChecked = this.checked;
            inputIds.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    if (isChecked) {
                        input.setAttribute('required', 'required');
                    } else {
                        input.removeAttribute('required');
                    }
                }
            });
        });
    </script>
@endpush
