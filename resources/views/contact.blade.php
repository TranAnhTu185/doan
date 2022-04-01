@extends('layouts.home')
@section('title', 'Liên hệ')
@section('content')
<div class="breadcrumb-area mt-37 hm-4-padding">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center border-top-2">
            <h2> Liên Hệ </h2>
            <ul>
                <li>
                    <a href="{{ route('home.contact') }}">Trang chủ</a>
                </li>
                <li>Liên hệ</li>
            </ul>
        </div>
    </div>
</div>
<div class="login-register-area hm-3-padding">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 ml-auto mr-auto">
                <h2 class="text-center text-uppercase">ShopBook</h2>
                <p>
                    <strong>ShopBook chuyên phân phối các loại sách lớn nhất Việt Nam</strong>
                </p>
                <p>Số điện thoại: 0977902031</p>
                <p>Hotline: 0123456789</p>
                <p>Email: nokshi@gmail.com</p>
                <p>Địa chỉ: Hà Nội</p>
            </div>
        </div>
    </div>
</div>
@endsection
