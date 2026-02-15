@php
    $categories = App\Models\Category::with('subCategories')->latest('id')->get();
    $user = auth('web')->user();
@endphp
<header id="header">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="contact-intro">
                        <span>A Marketplace Initiative by Themart Theme - save more with coupons</span>
                    </div>
                </div>
                <div class="col col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="contact-info">
                        <ul>
                            <li><a href="tel:869968236"><span>Need help? Call Us:</span>+ +869 968 236</a></li>
                            <li>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        English
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">English</a></li>
                                        <li><a class="dropdown-item" href="#">Bangla</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton2"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        USD
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <li><a class="dropdown-item" href="#">BDT</a></li>
                                        <li><a class="dropdown-item" href="#">USD</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end topbar -->
    <!--  start header-middle -->
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="{{ route('root') }}"><img
                                src="{{ asset('web/assets/images/logo.svg') }}" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <form action="#" class="middle-box">
                        <div class="category">
                            <select name="service" class="form-control">
                                <option disabled="disabled" selected="">All Category</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category?->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="search-box">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="What are you looking for?">
                                <button class="search-btn" type="submit"> <i class="fi flaticon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="middle-right">
                        <ul>
                            <li><a href="compare.html"><i class="fi flaticon-right-and-left"></i><span>Compare</span></a></li>
                            @if ($user)
                                <li class="d-flex justify-content-center align-items-center">
                                    <a href="#">
                                        <img src="{{ $user->thumbnail }}" style="width: 40px; height: 40px" class="rounded-circle border p-1 me-2" alt="">
                                        <span>{{ Str::limit($user->name, 10, '..') }}</span>
                                    </a>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}"><i class="fi flaticon-user-profile"></i><span>Login</span></a></li>
                            @endif
                            <li>
                                <div class="header-wishlist-form-wrapper">
                                    <button class="wishlist-toggle-btn">
                                        @php
                                            $wishListItems = $user?->wishListItems()->latest('id')->get();
                                            $wishListItemsCount = $wishListItems->count() ?? 0;
                                        @endphp
                                        <i class="fi flaticon-heart"></i>
                                        <span class="cart-count">{{ $wishListItemsCount }}</span>
                                    </button>
                                    <div class="mini-wislist-content">
                                        <button class="mini-cart-close"><i class="ti-close"></i></button>
                                        <div class="mini-cart-items">
                                            @foreach ($wishListItems ?? [] as $wishListItem)
                                                @php
                                                    $price = $wishListItem?->product?->discount_price > 0 ? $wishListItem?->product?->discount_price : $wishListItem?->product?->price;
                                                @endphp
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="{{ route('singleProduct', $wishListItem?->product?->slug) }}"><img
                                                            src="{{ $wishListItem?->product?->thumbnail }}"
                                                            alt="{{ $wishListItem?->product?->name }}"></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="{{ route('singleProduct', $wishListItem?->product?->slug) }}" title="{{ $wishListItem?->product?->name }}">{{ Str::limit($wishListItem?->product->name, '30', '...') }}</a>
                                                    <span class="mini-cart-item-price">৳{{ $wishListItem?->product?->formatBD($price) }}</span>
                                                    <span class="mini-cart-item-quantity"><a href="{{ route('wishlist.destroy', $wishListItem?->product?->id) }}"><i
                                                                class="ti-close"></i></a></span>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                        <div class="mini-cart-action clearfix">
                                            <div class="mini-btn">
                                                <a href="{{ route('wishlist') }}" class="view-cart-btn">View
                                                    Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                @php
                                    $cartItems = $user?->cartItems()->latest('id')->get();
                                    $cartItemsCount = $cartItems->count() ?? 0;
                                    $subTotal = 0;
                                @endphp
                                <div class="mini-cart">
                                    <button class="cart-toggle-btn"> <i class="fi flaticon-add-to-cart"></i>
                                        <span class="cart-count">{{ $cartItemsCount }}</span></button>
                                    <div class="mini-cart-content">
                                        <button class="mini-cart-close"><i class="ti-close"></i></button>
                                        <div class="mini-cart-items">
                                            @foreach ($cartItems ?? [] as $cartItem)
                                                @php
                                                    $price = $cartItem->product->discount_price > 0 ? $cartItem->product->discount_price : $cartItem->product->price;
                                                    $subTotal += $cartItem->quantity * ($cartItem->product->discount_price > 0 ? $cartItem->product->discount_price : $cartItem->product->price);
                                                @endphp
                                            <div class="mini-cart-item clearfix">
                                                <div class="mini-cart-item-image">
                                                    <a href="{{ $cartItem?->product?->slug }}"><img
                                                            src="{{ $cartItem?->product?->thumbnail }}"
                                                            alt="{{ $cartItem?->product?->name }}"></a>
                                                </div>
                                                <div class="mini-cart-item-des">
                                                    <a href="{{ $cartItem?->product?->slug }}" title="{{ $cartItem?->product?->name }}">{{ Str::limit($cartItem?->product?->name, '30', '...') }}</a>
                                                    <span class="mini-cart-item-price">৳{{ $cartItem?->product?->formatBD($price) }} x {{ $cartItem?->quantity }}</span>
                                                    <span class="mini-cart-item-quantity"><a href="{{ route('cart.destroy', $cartItem?->id) }}"><i
                                                                class="ti-close"></i></a></span>
                                                </div>
                                            </div>                                                
                                            @endforeach
                                            
                                        </div>
                                        <div class="mini-cart-action clearfix">
                                            @php
                                                $stAmount = $subTotal;
                                                $lastThree = substr($stAmount, -3);
                                                $restUnits = substr($stAmount, 0, -3);
                                                if ($restUnits != '') {
                                                    $restUnits = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $restUnits);
                                                    $finalSubTotal = $restUnits . ',' . $lastThree;
                                                } else {
                                                    $finalSubTotal = $stAmount;
                                                }
                                            @endphp
                                            <span class="mini-checkout-price">Subtotal:
                                                <span>৳{{ $finalSubTotal ?? 0 }}</span></span>
                                            <div class="mini-btn">
                                                <a href="{{ route('cart') }}" class="view-cart-btn">View Cart</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  end header-middle -->
    <div class="wpo-site-header">
        <nav class="navigation navbar navbar-expand-lg navbar-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 d-lg-none dl-block">
                        <div class="mobail-menu">
                            <button type="button" class="navbar-toggler open-btn">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar first-angle"></span>
                                <span class="icon-bar middle-angle"></span>
                                <span class="icon-bar last-angle"></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-6 col-sm-5 col-6 d-block d-lg-none">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="{{ route('root') }}"><img
                                    src="{{ asset('web/assets/images/logo.svg') }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-3">
                        <div class="header-shop-item">
                            <button class="header-shop-toggle-btn"><span>Shop By Category</span> </button>
                            <div class="mini-shop-item">
                                <ul id="metis-menu">
                                    @foreach ($categories ?? [] as $category)
                                        <li class="header-catagory-item">
                                            @if ($category?->subCategories && count($category?->subCategories) > 0)
                                                <a class="menu-down-arrow" href="#">{{ $category?->name }}</a>
                                                @if ($category?->subCategories && count($category?->subCategories) > 0)
                                                    <ul class="header-catagory-single">
                                                        @foreach ($category?->subCategories as $subCategory)
                                                            <li><a href="#">{{ $subCategory?->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @else
                                            <a href="#">{{ $category?->name }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-1 col-1">
                        <div id="navbar" class="collapse navbar-collapse navigation-holder">
                            <button class="menu-close"><i class="ti-close"></i></button>
                            <ul class="nav navbar-nav mb-2 mb-lg-0">
                                <li class="menu-item-has-children">
                                    <a href="{{ route('root') }}">Home</a>
                                </li>
                                <li><a href="{{ route('about') }}">About</a></li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('shop') }}">Shop</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ route('faq') }}">FAQ</a>
                                </li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>

                        </div><!-- end of nav-collapse -->
                    </div>
                    <div class="col-lg-2 col-md-1 col-1">
                        <div class="header-right">
                            <a href="recent-view.html" class="recent-btn"><i class="fi flaticon-refresh"></i>
                                <span>Recently Viewed</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- end of container -->
        </nav>
    </div>
</header>
