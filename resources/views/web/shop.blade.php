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
                            <li><a href="index.html">Home</a></li>
                            <li>Shop</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <!-- product-area-start -->
    <div class="shop-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="shop-filter-wrap">
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <div class="shop-filter-search">
                                    <form>
                                        <div>
                                            <input type="text" class="form-control" placeholder="Search..">
                                            <button type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item category-widget">
                                <h2>Categories</h2>
                                <ul>
                                    @foreach ($categories ?? [] as $category)
                                        @if ($category->products_count > 0)
                                            <li>
                                                <a href="#">{{ $category->name }}<span>({{ $category->products_count }})</span></a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Filter by price</h2>
                                <div class="shopWidgetWraper">
                                    <div class="priceFilterSlider">
                                        <form action="#" method="get" class="clearfix">
                                            <!-- <div id="sliderRange"></div>
                                                <div class="pfsWrap">
                                                    <label>Price:</label>
                                                    <span id="amount"></span>
                                                </div> -->
                                            <div class="d-flex">
                                                <div class="col-lg-6 pe-2">
                                                    <label for="" class="form-label">Min</label>
                                                    <input type="text" class="form-control" placeholder="Min"
                                                        value="0">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="" class="form-label">Max</label>
                                                    <input type="text" class="form-control" placeholder="Max"
                                                        value="100000">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mt-4">
                                                <button class="form-control bg-light">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Color</h2>
                                <ul>
                                    @foreach ($colors ?? [] as $color)
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            {{ $color->name }} <span>({{ $color->colors_count }})</span>
                                            <input type="radio" name="{{ $color->name }}">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item">
                                <h2>Size</h2>
                                <ul>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Small <span>(10)</span>
                                            <input type="radio" name="topcoat3">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Medium<span>(24)</span>
                                            <input type="radio" name="topcoat3">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Large<span>(13)</span>
                                            <input type="radio" name="topcoat3">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="topcoat-radio-button__label">
                                            Extra Large<span>(18)</span>
                                            <input type="radio" name="topcoat3">
                                            <span class="topcoat-radio-button"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item new-product">
                                <h2>New Products</h2>
                                <ul>
                                    @foreach ($newProducts as $product)
                                        <li>
                                            <div class="product-card">
                                                <div class="card-image">
                                                    <div class="image overflow-hidden ratio ratio-1x1">
                                                        <img src="{{ $product->thumbnail }}" style="object-fit:contain;"
                                                            alt="">
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <h3>
                                                        <a href="{{ route('singleProduct', $product->slug) }}" title="{{ $product->name }}">
                                                            {{ Str::words($product->name, 2, '..') }}
                                                        </a>
                                                    </h3>
                                                    <div class="rating-product">
                                                        <i class="fi flaticon-star"></i>
                                                        <i class="fi flaticon-star"></i>
                                                        <i class="fi flaticon-star"></i>
                                                        <i class="fi flaticon-star"></i>
                                                        <i class="fi flaticon-star"></i>
                                                        <span>30</span>
                                                    </div>
                                                    <div class="price">
                                                        @if ($product->discount_price > 0)
                                                            <span
                                                                class="present-price">৳{{ $product->discount_price }}</span>
                                                            <del class="old-price">৳{{ $product->price }}</del>
                                                        @else
                                                            <span class="present-price">৳{{ $product->price }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="filter-item">
                            <div class="shop-filter-item tag-widget">
                                <h2>Popular Tags</h2>
                                <ul>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Shoes</a></li>
                                    <li><a href="#">Kids</a></li>
                                    <li><a href="#">Theme</a></li>
                                    <li><a href="#">Stylish</a></li>
                                    <li><a href="#">Women</a></li>
                                    <li><a href="#">Shop</a></li>
                                    <li><a href="#">Men</a></li>
                                    <li><a href="#">Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="shop-section-top-inner">
                        <div class="shoping-product">
                            <p>We found <span>10 items</span> for you!</p>
                        </div>
                        <div class="short-by">
                            <ul>
                                <li>
                                    Sort by:
                                </li>
                                <li>
                                    <select name="show">
                                        <option value="">Default Sorting</option>
                                        <option value="">Low To High</option>
                                        <option value="">High To Low</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-wrap">
                        <div class="row align-items-center">
                            @foreach ($products as $product)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="product-item">
                                        <div class="image ratio ratio-1x1">
                                            <img src="{{ $product->thumbnail }}" style="object-fit: content;"
                                                alt="">
                                            <div class="tag new">New</div>
                                        </div>
                                        <div class="text">
                                            <h2>
                                                <a href="{{ route('singleProduct', $product->slug) }}" title="{{ $product->name }}">
                                                    {{ Str::limit($product->name, 20, '..') }}
                                                </a>
                                            </h2>
                                            <div class="rating-product">
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <i class="fi flaticon-star"></i>
                                                <span>130</span>
                                            </div>
                                            <div class="price">
                                                @if ($product->discount_price > 0)
                                                    <span class="present-price">৳{{ $product->discount_price }}</span>
                                                    <del class="old-price">৳{{ $product->price }}</del>
                                                @else
                                                    <span class="present-price">৳{{ $product->price }}</span>
                                                @endif
                                            </div>
                                            <div class="shop-btn">
                                                <a class="theme-btn-s2"
                                                    href="{{ route('singleProduct', $product->slug) }}">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product-area-end -->
@endsection
