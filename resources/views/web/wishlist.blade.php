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
                            <li>Wishlist</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- cart-area start -->
    <div class="cart-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-page-title">
                        <h2>Your Wishlist</h2>
                        <p>There are {{ $wishlistsCount }} products in this list</p>
                    </div>
                </div>
            </div>
            <div class="form">
                <div class="cart-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <form action="https://wpocean.com/html/tf/themart/cart">
                                <table class="table-responsive cart-wrap">
                                    <thead>
                                        <tr>
                                            <th class="images images-b">Product</th>
                                            <th class="ptice">Price</th>
                                            <th class="stock">Stock Status</th>
                                            <th class="remove remove-b">Action</th>
                                            <th class="remove remove-b">Remove</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($wishlists ?? [] as $wishlist)
                                        @php
                                            $price = $wishlist?->product?->discount_price > 0 ? $wishlist?->product?->discount_price : $wishlist?->product?->price;
                                        @endphp
                                        <tr class="wishlist-item">
                                            <td class="product-item-wish">
                                                <div class="check-box"><input type="checkbox" class="myproject-checkbox">
                                                </div>
                                                <div class="images">
                                                    <span>
                                                        <img src="{{ $wishlist?->product?->thumbnail }}" alt="{{ $wishlist?->product?->name }}">
                                                    </span>
                                                </div>
                                                <div class="product">
                                                    <ul>
                                                        <li class="first-cart">{{ Str::limit($wishlist?->product?->name, '30', '...') }}</li>
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
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="ptice">৳{{ $wishlist?->product?->formatBD($price) }}</td>
                                            <td class="stock">
                                                @if ($wishlist?->product?->stock > 0)
                                                <span class="in-stock">In Stock</span>
                                                    
                                                @else
                                                <span class="in-stock out-stock">Out Stock</span>
                                                    
                                                @endif
                                            </td>
                                            <td class="add-wish">
                                                <a class="theme-btn-s2" href="{{ route('singleProduct', $wishlist?->product?->slug) }}">Shop Now</a>
                                            </td>
                                            <td class="action">
                                                <ul>
                                                    <li class="w-btn"><a data-bs-toggle="tooltip" data-bs-html="true"
                                                            title="" href="{{ route('wishlist.destroy', $wishlist?->product?->id) }}" data-bs-original-title="Remove"
                                                            aria-label="Remove"><i class="fi flaticon-remove"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->
@endsection
