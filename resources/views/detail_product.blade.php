@extends('layouts.home')
@section('title')
    {{ $product->name }}
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('frontend\css\easyzoom.css') }}">
@endsection
@section('content')
<div class="breadcrumb-area mt-37 hm-4-padding">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center border-top-2">
            <h2>Chi tiết sản phẩm</h2>
            <ul>
                <li>
                    <a href="{{ route('home') }}" class="title">Trang chủ</a>
                </li>
                <li>Chi tiết sản phẩm</li>
            </ul>
        </div>
    </div>
</div>
<div class="product-details-area hm-3-padding mb-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-details-img-content">
                    <div class="product-details-tab mr-40">
                        <div class="product-details-large tab-content">
                            <div class="easyzoom easyzoom--overlay">
                                <a
                                    href="{{ asset('backend/images/product/'.$product->image) }}">
                                    <img src="{{ asset('backend/images/product/'.$product->image) }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-details-content">
                    <h2>{{ $product->name }}</h2>
                    <div class="product-price">
                        <span class="old">{{ number_format($product->price) }}</span>
                        <span>{{ number_format($product->newPrice()) }}</span>
                    </div>
                    <div class="product-overview">
                        <h5 class="pd-sub-title">Mô Tả</h5>
                        <p>{!! $product->description !!}</p>
                    </div>
                    <div class="quickview-plus-minus">
                        <form onsubmit="return quickView(this)" method="post">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="cart-plus-minus">
                                <input type="text" value="1" name="quantity" class="cart-plus-minus-box">
                            </div>
                            <div class="quickview-btn-cart">
                                <button type="submit" class="btn-style cr-btn" href="#"><span>Thêm vào giỏ hàng</span></button>
                            </div>
                        </form>
                    </div>
                    <div class="product-share">
                        <h5 class="pd-sub-title">Chia Sẻ</h5>
                        <ul>
                            <li>
                                <a href="#"><i class="ion-social-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="ion-social-tumblr"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="ion-social-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"> <i class="ion-social-instagram-outline"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="brand-logo-area hm-4-padding mb-3">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center border-top-2">
                <h2>Sản phẩm liên quan</h2>
            </div>
            <div class="row">
                @foreach($product_other as $item)
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="product-wrapper mb-35">
                            <div class="product-img">
                                <a href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">
                                    <img src="{{ asset('backend/images/product/'. $item->image) }}"
                                        alt="">
                                    @if ($item->sale > 0)
                                    <div class="price-decrease">
                                        <span>{{ $item->sale }}% off</span>
                                    </div>
                                    @endif
                                </a>
                                <div class="product-action-2">
                                    <a class="action-plus-2" onclick="qView({{ $item->id }})" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a class="action-cart-2" data-cart="add" data-id="5" title="Add To Cart" href="#">
                                        <i class="ti-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h4><a
                                        href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">{{ $item->name }}"</a>
                                </h4>
                                <div class="product-price">
                                    <span class="old">{{ number_format($item->price) }}₫</span>
                                    <span>{{ number_format($item->newPrice()) }}₫</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="brand-logo-area hm-4-padding mb-3">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center border-top-2">
                <h2>ĐÁNH GIÁ CỦA KHÁCH HÀNG</h2>
            </div>
            <div class="row w-1200px">
                @foreach($comments as $item)
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="comment-wrapper mb-25">
                            <h3 class="comment-title">{{ $item->customer->name }}</h3>
                            <div class="comment-content">
                                <p class="comment-content--time">{{ $item->created_at }}</p>
                                <p class="comment-content--des">{{ $item->content }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
