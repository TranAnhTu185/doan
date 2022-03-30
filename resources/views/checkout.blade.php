@extends('layouts.home')
@section('title', 'Thanh toán')
@section('content')
<div class="breadcrumb-area mt-37 hm-4-padding">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center border-top-2">
            <h2>thanh toán</h2>
            <ul>
                <li>
                    <a href="{{ route('home.index') }}">Trang chủ</a>
                </li>
                <li><a href="{{ route('home.cart') }}">giỏ hàng</a></li>
                <li>thanh toán</li>
            </ul>
        </div>
    </div>
</div>
<!-- checkout-area start -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="checkout-area hm-3-padding pb-100">
    <div class="container-fluid">
        <form action="{{ route('home.checkout') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="checkbox-form">
                        <h3>Chi tiết đơn hàng</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Người nhận <span class="required">*</span></label>
                                    <input type="text" name="name" placeholder="Họ tên" value="@if (Auth::guard('customer')->check()){{ Auth::guard('customer')->user()->name }}@endif" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Địa chỉ <span class="required">*</span></label>
                                    <input type="text" name="address" placeholder="Địa chỉ" value="@if (Auth::guard('customer')->check()){{ Auth::guard('customer')->user()->address }}@endif" required>
                                </div>
                            </div>
                            @if (!Auth::guard('customer')->check())
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email</label>
                                        <input type="email" name="email" id="email" placeholder="Email" value="@if (Auth::guard('customer')->check()){{ Auth::guard('customer')->user()->email }}@endif">
                                    </div>
                                </div>
                            @endif
                            <div @if(!Auth::guard('customer')->check()) class="col-md-6" @else class="col-md-12" @endif>
                                <div class="checkout-form-list">
                                    <label>Số điện thoại <span class="required">*</span></label>
                                    <input type="number" name="phone" placeholder="Số điện thoại" value="@if (Auth::guard('customer')->check()){{ Auth::guard('customer')->user()->phone }}@endif" required>
                                </div>
                            </div>
                        </div>
                        <div class="different-address">
                            <div class="order-notes">
                                <div class="checkout-form-list mrg-nn">
                                    <label>Ghi chú</label>
                                    <textarea name="note" id="checkout-mess" cols="30" rows="10"
                                        placeholder="Ghi chú cho đơn hàng"></textarea>
                                </div>
                            </div>
                            @if (!Auth::guard('customer')->check())
                                <div class="ship-different-title" id="password">
                                    <h5>
                                        <label>Điền mật khẩu để tạo tài khoản!</label>
                                        <input id="ship-box" type="checkbox">
                                    </h5>
                                </div>
                                <div id="ship-box-info" class="row">
                                    <div class="col-md-12">
                                        <div class="coupon-info">
                                            <p class="coupon-text">Tạo tài khoản để theo dõi đơn hàng.</p>
                                            <p class="form-row-last">
                                                <label>Mật khẩu</label>
                                                <input type="text" name="password"
                                                    placeholder="Nhập mật khẩu để tạo tài khoản">
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="your-order">
                        <h3>đơn hàng</h3>
                        <div class="your-order-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-name">Sản phẩm</th>
                                        <th class="product-total">Đơn giá</th>
                                    </tr>
                                </thead>
                                <tbody data-cart="products">
                                </tbody>
                                <tfoot>
                                    <tr class="order-total">
                                        <th>Tổng tiền</th>
                                        <td><strong><span class="amount" data-cart="total"></span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method mt-40">
                            <div class="payment-accordion">
                                <div class="panel-group" id="faq">
                                    @php
                                        $i = 1;
                                        $j = 1;
                                    @endphp
                                    @foreach ($payment_status as $item)
                                        <div class="panel panel-default">
                                            <div class="ship-different-title">
                                                <h5>
                                                    <label id="payment-{{ $i++ }}">{{ $item->name }}</label>
                                                    <input type="radio" name="payment_id" value="{{ $item->id }}" @if($i == 2) checked @endif>
                                                </h5>
                                            </div>
                                            @if (isset($item->note))
                                                <div id="box-payment-{{ $j++ }}" class="row" style="display:none">
                                                    <div class="col-md-12">
                                                        <div class="coupon-info">
                                                            <p class="coupon-text">{!! $item->note !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    {{-- <div class="panel panel-default">
                                        <div class="ship-different-title">
                                            <h5>
                                                <label id="payment-2">Thanh toán online</label>
                                                <input type="radio" name="payments" value="1">
                                            </h5>
                                        </div>
                                        <div id="box-payment-2" class="row" style="display:none">
                                            <div class="col-md-12">
                                                <div class="coupon-info">
                                                    <p class="coupon-text">Khách hàng vui lòng thanh toán vào
                                                        STK:686868686868686868</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="order-button-payment">
                                    <input type="submit" value="đặt hàng">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#password").hide();
    $("#email").on("keyup", function(){
        let email = $(this).val();
        if(email != "") {
            $("#password").show();
        } else {
            $("#password").hide();
        }
    });

    $(".header-cart").remove();

    function load(cart) {
        let list = $("[data-cart='products']");
        list.html("");
        let total = 0;


        $.each(cart, function (id, prod) {
            total += prod.quantity * prod.product.price;
            list.append('<tr class="cart_item">\
                                <td class="product-name">\
                                    <a href="' + prod.link + '">' + prod.product.name +
                ' <strong class="product-quantity"> × ' + prod.quantity + '</strong></a>\
                                </td>\
                                <td class="product-total">\
                                    <span class="amount">' + formatNumber(prod.product.price) + '</span>\
                                </td>\
                            </tr>');
        });

        $("[data-cart='total']").html("Tổng cộng: " + formatNumber(total));

        if (cart['count'] == 0) {
            list.append('<tr><td colspan="5" class="text-center">Không có sản phẩm nào trong giỏ hàng</td></tr>');
            $(".btn-checkout").remove();
        }
    }
</script>
@endsection
