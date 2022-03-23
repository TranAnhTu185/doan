@extends('layouts.home')
@section('title')
    Danh sách sản phẩm
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
@endsection
@section('content')
<div class="breadcrumb-area mt-37 hm-4-padding">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center border-top-2">
            <h2>Danh sách sản phẩm</h2>
            <ul>
                <li>
                    <a href="#">Trang chủ</a>
                </li>
                <li>Danh sách</li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-wrapper hm-3-padding mb-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="shop-topbar-wrapper">
                    <div class="grid-list-options">
                        <ul class="view-mode">
                            <li class="active"><a href="#product-grid" data-view="product-grid"><i
                                        class="ion-grid"></i></a></li>
                            <li><a href="#product-list" data-view="product-list"><i class="ion-navicon"></i></a></li>
                        </ul>
                    </div>
                    {{-- <div class="shop-filter">
                        <button class="product-filter-toggle">filter</button>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="product-filter-wrapper">
                    <div class="row">
                        <div class="product-filter col-md-3 col-sm-6 col-xs-12 mb-30">
                            <h5>Sort by</h5>
                            <ul class="sort-by">
                                <li><a href="#">Default</a></li>
                                <li><a href="#">Popularity</a></li>
                                <li><a href="#">Average rating</a></li>
                                <li><a href="#">Newness</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                            </ul>
                        </div>
                        <div class="product-filter col-md-3 col-sm-6 col-xs-12 mb-30">
                            <h5>color filters</h5>
                            <ul class="color-filter">
                                <li><a href="#"><i style="background-color: #000000;"></i>Black</a></li>
                                <li><a href="#"><i style="background-color: #663300;"></i>Brown</a></li>
                                <li><a href="#"><i style="background-color: #FF6801;"></i>Orange</a></li>
                                <li><a href="#"><i style="background-color: #ff0000;"></i>red</a></li>
                                <li><a href="#"><i style="background-color: #FFEE00;"></i>Yellow</a></li>
                            </ul>
                        </div>
                        <div class="product-filter col-md-3 col-sm-6 col-xs-12 mb-30">
                            <h5>product tags</h5>
                            <div class="product-tags">
                                <a href="#">New ,</a>
                                <a href="#">brand ,</a>
                                <a href="#">black ,</a>
                                <a href="#">white ,</a>
                                <a href="#">chire ,</a>
                                <a href="#">table ,</a>
                                <a href="#">Lorem ,</a>
                                <a href="#">ipsum ,</a>
                                <a href="#">dolor ,</a>
                                <a href="#">sit ,</a>
                                <a href="#">amet ,</a>
                            </div>
                        </div>
                        <div class="product-filter col-md-3 col-sm-6 col-xs-12 mb-30">
                            <h5>Filter by price</h5>
                            <div id="price-range"></div>
                            <div class="price-values">
                                <span>Price:</span>
                                <input type="text" class="price-amount">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="grid-list-product-wrapper">
            <div class="product-grid product-view">
                <div class="row">
                    @if($list->count() == 0)
                        <div class="product-width text-center w-100">
                            <p>Danh mục hiện tại không có sản phẩm.</p>
                        </div>
                    @else
                        @foreach($list as $item)
                            <div class="product-width col-md-6 col-xl-3 col-lg-4">
                                <div class="product-wrapper mb-35">
                                    <div class="product-img">
                                        <a href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">
                                            <img src="{{ asset('backend/images/product/'.$item->product_image[0]->name) }}"
                                                alt="">
                                        </a>
                                        @if($item->sale > 0)
                                            <div class="price-decrease">
                                                <span>{{ $item->sale }}% off</span>
                                            </div>
                                        @endif
                                        <div class="product-action-2">
                                            <a class="action-plus-2" onclick="qView({{ $item->id }})" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                                <i class="ti-eye"></i>
                                            </a>
                                            <a class="action-cart-2" data-cart="add" data-id="5" title="Add To Cart" href="#">
                                                <i class="ti-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-title-wishlist">
                                            <div class="product-title-3">
                                                <h4><a
                                                        href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">{{ $item->name }}</a>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="product-peice-addtocart">
                                            <div class="product-peice-3">
                                                @if ($item->sale > 0)
                                                    <span class="old">{{ number_format($item->price) }}₫</span>
                                                @endif
                                                <span>{{ number_format($item->newPrice()) }}₫</span>
                                            </div>
                                            <div class="product-addtocart">
                                                <a href="#" data-cart="add" data-id="{{ $item->id }}"> <i class="ti-shopping-cart"></i> Add to cart</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-list-details">
                                        <h2><a
                                                href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">{{ $item->name }}</a>
                                        </h2>
                                        <div class="product-rating">
                                            <i class="ion-ios-star"></i>
                                            <i class="ion-ios-star"></i>
                                            <i class="ion-ios-star"></i>
                                            <i class="ion-ios-star"></i>
                                            <i class="ion-ios-star"></i>
                                        </div>
                                        <div class="product-price">
                                            <span class="old">{{ number_format($item->price) }}₫</span>
                                            <span>{{ number_format($item->newPrice()) }}₫</span>
                                        </div>
                                        <p>{!! $item->description !!}</p>
                                        <div class="shop-list-cart">
                                            <a href="#" data-cart="add" data-id ="{{ $item->id }}"><i class="ti-shopping-cart"></i> Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="pagination-style text-center mt-30">
                    <ul>
                        <li>
                            {!! $list->links() !!}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
