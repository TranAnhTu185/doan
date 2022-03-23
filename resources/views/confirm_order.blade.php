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
                <p>Khách hàng đặt hành online vui lòng thanh toán để xác thực đơn hàng.
                    @if(Auth::guard('customer')->check())
                        Để xem lịch sử đơn hàng <a class="text-danger"
                                href="{{ route('home.checkout.history') }}">click tại đây</a>.
                    @else
                        Kiểm tra email để xem thông tin đơn hàng.
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
