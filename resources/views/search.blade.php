@extends('layouts.home')
@section('title')
    Tìm kiếm
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.css') }}">
@endsection
@section('content')
<div class="breadcrumb-area mt-37 hm-4-padding">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center border-top-2">
            <h2>Tìm kiếm</h2>
            <ul>
                <li>
                    <a href="#">Trang chủ</a>
                </li>
                <li>tìm kiếm</li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-wrapper hm-3-padding mb-">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="shop-topbar-wrapper">
                    <div class="grid-list-options">
                        <ul class="view-mode">
                            <li><a href="#product-grid" data-view="product-grid"><i
                                        class="ion-grid"></i></a></li>
                            <li class="active"><a href="#product-list" data-view="product-list"><i class="ion-navicon"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-list-product-wrapper">
            <div class="product-list product-view">
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
                                            <img src="{{ asset('backend/images/product/'.$item->image) }}"
                                                alt="">
                                        </a>
                                        @if($item->sale > 0)
                                            <div class="price-decrease">
                                                <span>{{ $item->sale }}% off</span>
                                            </div>
                                        @endif
                                        <div class="product-action-3">
                                            <a class="action-plus-2" title="Quick View" data-toggle="modal"
                                                data-target="#exampleModal" href="#">
                                                <i class="ti-plus"></i> Quict View
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
                                                    <span class="old">{{ number_format($item->price) }}</span>
                                                @endif
                                                <span>{{ number_format($item->newPrice()) }}</span>
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
                                            <span class="old">{{ number_format($item->price) }}</span>
                                            <span>{{ number_format($item->newPrice()) }}</span>
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
