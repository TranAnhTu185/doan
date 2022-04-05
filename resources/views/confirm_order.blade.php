@extends('layouts.home')
@section('title', 'Thanh toán')
@section('content')
<!-- checkout-area start -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="check">
                <img src="{{ asset('frontend/img/cart/thanh-cong.png') }}"
                    class="img-check d-block w-100">
            </div>
            <div class="text-center mt-3">
                <h3>Đặt hàng thành công</h3>
                <p>Cảm ơn quý khách đã ủng hộ công ty chúng tôi.</p>
                <a class="btn-style cr-btn" href="{{ route('home.index') }}">
                    <span>Tiếp tục mua hàng</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
