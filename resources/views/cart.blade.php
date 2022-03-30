@extends('layouts.home')
@section('title')
Giỏ hàng
@endsection
@section('content')
<div class="breadcrumb-area mt-37 hm-4-padding">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center border-top-2">
            <h2>giỏ hàng</h2>
            <ul>
                <li>
                    <a href="{{ route('home.index') }}">trang chủ</a>
                </li>
                <li>giỏ hàng</li>
            </ul>
        </div>
    </div>
</div>
<div class="product-cart-area hm-3-padding mb-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th class="product-name">Ảnh</th>
                                <th class="product-price">Tên sản phẩm</th>
                                <th class="product-name">Đơn giá</th>
                                <th class="product-price">Số lượng</th>
                                <th class="product-quantity">Tổng tiền</th>
                                <th class="product-subtotal">Xoá</th>
                            </tr>
                        </thead>
                        <tbody data-cart="products">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="cart-shiping-update">
                    <div class="cart-shipping">
                        <a class="btn-style cr-btn" href="{{ route('home.index') }}">
                            <span>Tiếp tục mua hàng</span>
                        </a>
                    </div>
                    <div class="update-checkout-cart">
                        <div class="update-cart">
                            <button class="btn-style">
                                <div data-cart="total"></div>
                            </button>
                        </div>
                        <div class="update-cart btn-checkout">
                            <a class="btn-style cr-btn" href="{{ route('home.checkout') }}">
                                <span>thanh toán</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(".header-cart").remove();


    function load(cart) {
        let list = $("[data-cart='products']");
        list.html("");
        let total = 0;

        $.each(cart, function (id, prod) {
            total += prod.quantity * prod.product.price;
            list.append('<tr>\
                            <td class="product-thumbnail">\
                                <a href="#"><img src="'+ '/backend/images/product/' + prod.product.product_image[0].name+'" alt=""></a>\
                            </td>\
                            <td class="product-name">\
                                <a href="' + prod.link + '">' + prod.product.name + '</a>\
                            </td>\
                            <td class="product-price"><span class="amount">' + prod.product.price + '</span></td>\
                            <td class="product-quantity">\
                                <div class="quantity-range quantity">' +prod.quantity+ '</div>\
                            </td>\
                            <td class="product-subtotal">' + prod.product.price * prod.quantity + '</td>\
                            <td class="product-cart-icon product-subtotal"><a href="#" onclick="removeCart(this, '+prod.product_id+')"><i class="ion-ios-trash-outline" aria-hidden="true"></i></a></td>\
                        </tr>');
        });

        $("[data-cart='total']").html("Tổng cộng: " + formatNumber(total));

        if (cart['count'] == 0) {
            list.append('<tr><td colspan="5" class="text-center">Không có sản phẩm nào trong giỏ hàng</td></tr>');
            $(".btn-checkout").remove();
        }
    }


    function changeQty(e, id) {
        $.get('/gio-hang/sua', {
            id: id,
            quantity: e.value
        }, function (data, status) {
            console.log(data);
            if (status == 'success' && data.status != 'error') {
                load(data);
            }
        });
    }
</script>
@endsection
