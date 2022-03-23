@extends('layouts.home')
@section('title')
    Trang chủ
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($slideShow as $item)
                            <div class="carousel-item {{ $item == $slideShow[0] ? 'active' : '' }}">
                                <img src=" {{ asset('backend/images/carousel/'.$item->name) }}"
                                     class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="product-area mt-5 product-padding">
        <div class="container-fluid">
            <div class="section-title-2 text-center mb-25">
                <h2 class="m-0">DANH MỤC</h2>
            </div>
            <div class="product-tab-list text-center mb-60 nav product-menu-mrg" role="tablist">
                <a class="active" href="#home4" data-toggle="tab">
                    <h4>Đặc sắc </h4>
                </a>
                <a href="#home5" data-toggle="tab">
                    <h4> Giới hạn </h4>
                </a>
                <a href="#home6" data-toggle="tab">
                    <h4>Giảm giá</h4>
                </a>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="home4" role="tabpanel">
                    <div class="row">
                        @foreach($product_featured as $item)
                            <div class="col-lg-3 col-md-4 col-12">
                                <div class="product-wrapper mb-35">
                                    <div class="product-img">
                                        <a href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">
                                            <img src="{{ asset('backend/images/product/'. $item->product_image[0]->name) }}"
                                                 alt="">
                                            @if($item->sale > 0)
                                                <div class="price-decrease">
                                                    <span>{{ $item->sale }}% off</span>
                                                </div>
                                            @endif
                                        </a>
                                        <div class="product-action-2">
                                            <a class="action-plus-2" onclick="qView({{ $item->id }})" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                                <i class="ti-eye"></i>
                                            </a>
                                            <a class="action-cart-2" data-cart="add" data-id="{{ $item->id }}" title="Add To Cart" href="#">
                                                <i class="ti-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <h4><a
                                                href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">{{ $item->name }}</a>
                                        </h4>
                                        <div class="product-price">
                                            @if ($item->price != $item->newPrice())
                                                <span class="old">{{ number_format($item->price) }}₫</span>
                                            @endif
                                            <span>{{ number_format($item->newPrice()) }}₫</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane" id="home5" role="tabpanel">
                    <div class="row">
                        @foreach($product_limited as $item)
                            <div class="col-lg-3 col-md-4 col-12">
                                <div class="product-wrapper mb-35">
                                    <div class="product-img">
                                        <a href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">
                                            <img src="{{ asset('backend/images/product/'. $item->product_image[0]->name) }}"
                                                 alt="">
                                            @if($item->sale > 0)
                                                <div class="price-decrease">
                                                    <span>{{ $item->sale }}% off</span>
                                                </div>
                                            @endif
                                        </a>
                                        <div class="product-action-2">
                                            <a class="action-plus-2" onclick="qView({{ $item->id }})" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                                <i class="ti-eye"></i>
                                            </a>
                                            <a class="action-cart-2" data-cart="add" data-id="{{ $item->id }}" title="Add To Cart" href="#">
                                                <i class="ti-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <h4><a
                                                href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">{{ $item->name }}</a>
                                        </h4>
                                        <div class="product-price">
                                            @if ($item->price != $item->newPrice())
                                                <span class="old">{{ number_format($item->price) }}₫</span>
                                            @endif
                                            <span>{{ number_format($item->newPrice()) }}₫</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane" id="home6" role="tabpanel">
                    <div class="row">
                        @foreach($product_sale as $item)
                            <div class="col-lg-3 col-md-4 col-12">
                                <div class="product-wrapper mb-35">
                                    <div class="product-img">
                                        <a href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">
                                            <img src="{{ asset('backend/images/product/'. $item->product_image[0]->name) }}"
                                                 alt="">
                                            <div class="price-decrease">
                                                <span>{{ $item->sale }}% off</span>
                                            </div>
                                        </a>
                                        <div class="product-action-2">
                                            <a class="action-plus-2" onclick="qView({{ $item->id }})" title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                                <i class="ti-eye"></i>
                                            </a>
                                            <a class="action-cart-2" data-cart="add" data-id="{{ $item->id }}" title="Add To Cart" href="#">
                                                <i class="ti-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-content text-center">
                                        <h4><a
                                                href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">{{ $item->name }}"</a>
                                        </h4>
                                        <div class="product-price">
                                            @if ($item->price != $item->newPrice())
                                                <span class="old">{{ number_format($item->price) }}₫</span>
                                            @endif
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
    </div>
    <div class="product-area mt-5 product-padding">
        <div class="container-fluid">
            <div class="section-title-2 text-center mb-55">
                <h2 class="mb-12">SẢN PHẨM MỚI</h2>
                <p>Liên tục cập nhật sản phẩm chất lượng cao.</p>
            </div>
            <div class="row">
                @foreach($product_new as $item)
                    <div class="col-lg-3 col-md-4 col-12">
                        <div class="product-wrapper mb-35">
                            <div class="product-img">
                                <a href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">
                                    <img src="{{ asset('backend/images/product/'. $item->product_image[0]->name) }}"
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
                                    <a class="action-cart-2" data-cart="add" data-id="{{ $item->id }}" title="Add To Cart" href="#">
                                        <i class="ti-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-content text-center">
                                <h4><a
                                        href="{{ route('home.detail', [$item->id, $item->getUrl()]) }}">{{ $item->name }}</a>
                                </h4>
                                <div class="product-price">
                                    @if ($item->price != $item->newPrice())
                                        <span class="old">{{ number_format($item->price) }}₫</span>
                                    @endif
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

    <div class="services-area services-padding mb-5">
        <div class="container-fluid">
            <div class="services-wrapper">
                <div class="single-services mb-30">
                    <div class="services-icon">
                        <img alt="" src="frontend\img\icon-img\3.png">
                    </div>
                    <div class="services-text">
                        <h5>MIỄN PHÍ GIAO HÀNG</h5>
                        <p>Miễn phí vận chuyển mọi đơn hàng</p>
                    </div>
                </div>
                <div class="single-services mb-30">
                    <div class="services-icon">
                        <img alt="" src="frontend\img\icon-img\4.png">
                    </div>
                    <div class="services-text">
                        <h5>Hỗ trợ trực tuyến</h5>
                        <p>Hỗ trợ 24/7</p>
                    </div>
                </div>
                <div class="single-services mb-30">
                    <div class="services-icon">
                        <img alt="" src="frontend\img\icon-img\5.png">
                    </div>
                    <div class="services-text">
                        <h5>Hoàn tiền</h5>
                        <p>Hoàn tiền trong vòng 1 tuần</p>
                    </div>
                </div>
                <div class="single-services mb-30">
                    <div class="services-icon">
                        <img alt="" src="frontend\img\icon-img\6.png">
                    </div>
                    <div class="services-text">
                        <h5>Giảm giá</h5>
                        <p>Ưu đãi giảm giá với member</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
