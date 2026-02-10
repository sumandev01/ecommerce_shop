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
                            <li><a href="{{ route('shop') }}">Product</a></li>
                            <li>Product Single</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- product-single-section  start-->
    <div class="product-single-section section-padding">
        <div class="container">
            <div class="product-details">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="product-single-img">
                            <div class="product-active owl-carousel">
                                @if ($product->media_id)
                                    <div class="item ratio ratio-1x1">
                                        <img src="{{ $product->thumbnail }}" style="object-fit: contain;" alt="">
                                    </div>
                                @endif
                                @foreach ($productGalleries ?? [] as $gallery)
                                    <div class="item ratio ratio-1x1">
                                        <img src="{{ Storage::url($gallery->src) }}" style="object-fit: contain;"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                            <div class="product-thumbnil-active  owl-carousel">
                                @if ($product->media_id)
                                    <div class="item ratio ratio-1x1">
                                        <img src="{{ $product->thumbnail }}" style="object-fit: contain;" alt="">
                                    </div>
                                @endif
                                @foreach ($productGalleries ?? [] as $gallery)
                                    <div class="item ratio ratio-1x1">
                                        <img src="{{ Storage::url($gallery->src) }}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form action="{{ route('addToCart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product?->id }}">
                            <input type="hidden" name="inventoryId" id="inventory_id_input" value="">
                            <div class="product-single-content">
                                <h2 class="text-start">{{ $product?->name }}</h2>
                                <div class="price">
                                    @if ($product?->discount_price > 0)
                                        <span class="present-price">৳{{ $product?->discount_price }}</span>
                                        <del class="old-price">৳{{ $product?->price }}</del>
                                    @else
                                        <span class="present-price">৳{{ $product?->price }}</span>
                                    @endif
                                </div>
                                <div class="rating-product">
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <i class="fi flaticon-star"></i>
                                    <span>120</span>
                                </div>
                                <p>{{ $product?->details?->short_description }}</p>
                                @if ($colors->isNotEmpty())
                                    <div class="product-filter-item color">
                                        <div class="color-name">
                                            <span>Color :</span>
                                            <ul>
                                                @foreach ($colors ?? [] as $color)
                                                    <li class="{{ $color?->name }}">
                                                        <input id="{{ $color?->name }}" type="radio" name="color"
                                                            value="{{ $color?->id }}">
                                                        <label for="{{ $color?->name }}"
                                                            style="background-color: {{ $color?->hex_code }};"></label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                @if ($sizes->isNotEmpty())
                                    <div class="product-filter-item color filter-size">
                                        <div class="color-name">
                                            <span>Sizes:</span>
                                            <ul>
                                                @foreach ($sizes ?? [] as $size)
                                                    <li class="{{ $size?->name }}"><input id="{{ $size?->name }}"
                                                            type="radio" name="size" value="{{ $size?->id }}">
                                                        <label for="{{ $size?->name }}">{{ $size?->name }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="product-inventory-status mt-3">
                                    <p id="stock-display">
                                        <strong>Availability:</strong>
                                        <span id="stock-count"
                                            class="badge {{ $product?->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                            @if ($product?->stock > 0)
                                                {{ $product?->stock }} Items in Stock
                                            @else
                                                Sold Out
                                            @endif
                                        </span>
                                    </p>
                                </div>
                                <div class="pro-single-btn">
                                    <div class="quantity cart-plus-minus">
                                        <input class="text-value" type="text" name="quantity" value="1">
                                    </div>
                                    @php
                                        // $isSelectionRequired = $colors->isNotEmpty() || $sizes->isNotEmpty();
                                    @endphp
                                    <button type="submit" class="theme-btn-s2 border-0">Add to cart</button>
                                    <a href="#" class="wl-btn"><i class="fi flaticon-heart"></i></a>
                                </div>
                                <ul class="important-text">
                                    <li><span>SKU: </span>{{ $product?->sku_code ?? 'N/A' }}</li>
                                    <li><span>Categories: </span>{{ $product?->details?->category?->name ?? 'N/A' }},
                                        {{ $product?->details?->subCategory?->name ?? 'N/A' }}</li>
                                    <li><span>Tags: </span>{{ $tags->pluck('name')->implode(', ') ?? 'N/A' }}</li>
                                    <li><span>Brand: </span>{{ $product?->details?->brand?->name ?? 'N/A' }}</li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="product-tab-area">
                <ul class="nav nav-mb-3 main-tab" id="tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="descripton-tab" data-bs-toggle="pill"
                            data-bs-target="#descripton" type="button" role="tab" aria-controls="descripton"
                            aria-selected="true">Description</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Ratings-tab" data-bs-toggle="pill" data-bs-target="#Ratings"
                            type="button" role="tab" aria-controls="Ratings" aria-selected="false">Reviews
                            (3)</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Information-tab" data-bs-toggle="pill"
                            data-bs-target="#Information" type="button" role="tab" aria-controls="Information"
                            aria-selected="false">Additional info</button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="descripton" role="tabpanel"
                        aria-labelledby="descripton-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="Descriptions-item">
                                        {!! $product?->details?->long_description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Ratings" role="tabpanel" aria-labelledby="Ratings-tab">
                        <div class="container">
                            <div class="rating-section">
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <div class="comments-area">
                                            <div class="comments-section">
                                                <h3 class="comments-title">3 reviews for Stylish Pink Coat</h3>
                                                <ol class="comments">
                                                    <li class="comment even thread-even depth-1" id="comment-1">
                                                        <div id="div-comment-1">
                                                            <div class="comment-theme">
                                                                <div class="comment-image"><img
                                                                        src="{{ asset('web/assets/images/blog-details/comments-author/img-1.jpg') }}"
                                                                        alt></div>
                                                            </div>
                                                            <div class="comment-main-area">
                                                                <div class="comment-wrapper">
                                                                    <div class="comments-meta">
                                                                        <h4>Lily Zener</h4>
                                                                        <span class="comments-date">December 25, 2022 at
                                                                            5:30 am</span>
                                                                        <div class="rating-product">
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="comment-area">
                                                                        <p>Turpis nulla proin donec a ridiculus. Mi
                                                                            suspendisse faucibus sed lacus. Vitae risus eu
                                                                            nullam sed quam.
                                                                            Eget aenean id augue pellentesque turpis magna
                                                                            egestas arcu sed.
                                                                            Aliquam non faucibus massa adipiscing nibh sit.
                                                                            Turpis integer aliquam aliquam aliquam.
                                                                            <a class="comment-reply-link"
                                                                                href="#"><span>Reply...</span></a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <ul class="children">
                                                            <li class="comment">
                                                                <div>
                                                                    <div class="comment-theme">
                                                                        <div class="comment-image"><img
                                                                                src="{{ asset('web/assets/images/blog-details/comments-author/img-2.jpg') }}"
                                                                                alt></div>
                                                                    </div>
                                                                    <div class="comment-main-area">
                                                                        <div class="comment-wrapper">
                                                                            <div class="comments-meta">
                                                                                <h4>Leslie Alexander</h4>
                                                                                <div class="rating-product">
                                                                                    <i class="fi flaticon-star"></i>
                                                                                    <i class="fi flaticon-star"></i>
                                                                                    <i class="fi flaticon-star"></i>
                                                                                    <i class="fi flaticon-star"></i>
                                                                                    <i class="fi flaticon-star"></i>
                                                                                </div>
                                                                                <span class="comments-date">December 26,
                                                                                    2022 at 5:30 am</span>
                                                                            </div>
                                                                            <div class="comment-area">
                                                                                <p>Turpis nulla proin donec a ridiculus. Mi
                                                                                    suspendisse faucibus sed lacus. Vitae
                                                                                    risus eu nullam sed quam.
                                                                                    Eget aenean id augue pellentesque turpis
                                                                                    magna egestas arcu sed.
                                                                                    Aliquam non faucibus massa adipiscing
                                                                                    nibh sit. Turpis integer aliquam aliquam
                                                                                    aliquam.
                                                                                    <a class="comment-reply-link"
                                                                                        href="#"><span>Reply...</span></a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="comment">
                                                        <div>
                                                            <div class="comment-theme">
                                                                <div class="comment-image"><img
                                                                        src="{{ asset('web/assets/images/blog-details/comments-author/img-1.jpg') }}"
                                                                        alt></div>
                                                            </div>
                                                            <div class="comment-main-area">
                                                                <div class="comment-wrapper">
                                                                    <div class="comments-meta">
                                                                        <h4>Jenny Wilson</h4>
                                                                        <div class="rating-product">
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                            <i class="fi flaticon-star"></i>
                                                                        </div>
                                                                        <span class="comments-date">December 30, 2022 at
                                                                            3:12 pm</span>
                                                                    </div>
                                                                    <div class="comment-area">
                                                                        <p>Turpis nulla proin donec a ridiculus. Mi
                                                                            suspendisse faucibus sed lacus. Vitae risus eu
                                                                            nullam sed quam.
                                                                            Eget aenean id augue pellentesque turpis magna
                                                                            egestas arcu sed.
                                                                            Aliquam non faucibus massa adipiscing nibh sit.
                                                                            Turpis integer aliquam aliquam aliquam.
                                                                            <a class="comment-reply-link"
                                                                                href="#"><span>Reply...</span></a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </div> <!-- end comments-section -->
                                            <div class="col col-lg-10 col-12 review-form-wrapper">
                                                <div class="review-form">
                                                    <h4>Add a review</h4>
                                                    <form>
                                                        <div class="give-rat-sec">
                                                            <div class="give-rating">
                                                                <label>
                                                                    <input type="radio" name="stars" value="1">
                                                                    <span class="icon">★</span>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="stars" value="2">
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="stars" value="3">
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="stars" value="4">
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" name="stars" value="5">
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                    <span class="icon">★</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <textarea class="form-control" placeholder="Write Comment..."></textarea>
                                                        </div>
                                                        <div class="name-input">
                                                            <input type="text" class="form-control" placeholder="Name"
                                                                required>
                                                        </div>
                                                        <div class="name-email">
                                                            <input type="email" class="form-control"
                                                                placeholder="Email" required>
                                                        </div>
                                                        <div class="rating-wrapper">
                                                            <div class="submit">
                                                                <button type="submit" class="theme-btn-s2">Post
                                                                    review</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- end comments-area -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Information" role="tabpanel" aria-labelledby="Information-tab">
                        <div class="container">
                            <div class="Additional-wrap">
                                {!! $product?->details?->additional_info !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="related-product">
        </div>
    </div>
    <!-- product-single-section  end-->
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            let totalColors = {{ $colors->count() }};
            let totalSizes = {{ $sizes->count() }};
            const defaultProductStock = {{ $product->stock > 0 ? $product->stock : 0 }};

            if (defaultProductStock <= 0) {
                disableAddToCart();
                $('#stock-count').text('Sold Out').addClass('bg-danger');
            } else if (totalColors > 0) {
                disableAddToCart();
                $('input[name="size"]').prop('disabled', true).parent('li').css('opacity', '0.3');
            }

            function updateInventory(triggerType) {
                let colorId = $('input[name="color"]:checked').val();
                let sizeId = $('input[name="size"]:checked').val();
                let productId = "{{ $product->id }}";

                $.ajax({
                    url: "{{ route('getProdutVariantInventory') }}",
                    method: "GET",
                    data: {
                        colorId: colorId,
                        sizeId: sizeId,
                        productId: productId
                    },
                    success: function(response) {
                        $('#inventory_id_input').val(response.inventory || '');

                        if (triggerType === 'color' && totalSizes > 0) {
                            $('input[name="size"]').prop('checked', false).prop('disabled', true)
                                .parent('li').css('opacity', '0.3');

                            if (response.availableSizeIds && response.availableSizeIds.length > 0) {
                                response.availableSizeIds.forEach(function(id) {
                                    let sizeInput = $('input[name="size"][value="' + id + '"]');
                                    sizeInput.prop('disabled', false).parent('li').css(
                                        'opacity', '1');
                                });
                            }

                            $('#stock-count').text('Select Size').removeClass('bg-success').addClass(
                                'bg-danger');
                            disableAddToCart();
                            return;
                        }

                        let canAddToCart = false;
                        if (totalColors > 0 && totalSizes > 0) {
                            if (colorId && sizeId && response.stock >= 1) canAddToCart = true;
                        } else if (totalColors > 0 && totalSizes === 0) {
                            if (colorId && response.stock >= 1) canAddToCart = true;
                        } else if (totalColors === 0 && totalSizes > 0) {
                            if (sizeId && response.stock >= 1) canAddToCart = true;
                        } else {
                            if (response.stock >= 1) canAddToCart = true;
                        }

                        if (canAddToCart) {
                            $('#stock-count').text(response.stock + ' Items in Stock')
                                .removeClass('bg-danger').addClass('bg-success');
                            enableAddToCart();
                        } else {
                            disableAddToCart();
                            if (response.stock < 1) {
                                $('#stock-count').text('Sold Out').removeClass('bg-success').addClass(
                                    'bg-danger');
                            } else if (colorId && !sizeId && totalSizes > 0) {
                                $('#stock-count').text('Select Size').addClass('bg-danger');
                            }
                        }
                    }
                });
            }

            function disableAddToCart() {
                $('.theme-btn-s2').css({
                    'pointer-events': 'none',
                    'opacity': '0.5'
                });
            }

            function enableAddToCart() {
                $('.theme-btn-s2').css({
                    'pointer-events': 'auto',
                    'opacity': '1'
                });
            }

            $('input[name="color"]').on('change', function() {
                updateInventory('color');
            });
            $('input[name="size"]').on('change', function() {
                updateInventory('size');
            });
        });
    </script>
@endpush
