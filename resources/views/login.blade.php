@extends('layouts.home')
@section('title', 'Đăng nhập')
@section('content')
<div class="breadcrumb-area mt-37 hm-4-padding">
    <div class="container-fluid">
        <div class="breadcrumb-content text-center border-top-2">
            <h2>Đăng nhập & đăng ký</h2>
            <ul>
                <li>
                    <a href="{{ route('home') }}">trang chủ</a>
                </li>
                <li>Đăng nhập & đăng ký</li>
            </ul>
        </div>
    </div>
</div>
<div class="login-register-area hm-3-padding mb-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> đăng nhập </h4>
                        </a>
                        <a data-toggle="tab" href="#lg2">
                            <h4> đăng ký </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <div class="login-form-container">
                                <div class="login-form">
                                    <form action="{{ route('home.login') }}" method="post">
                                        @csrf
                                        <label>Email</label>
                                        <input type="text" name="email" placeholder="Email">
                                        <label>Mật khẩu</label>
                                        <input type="password" name="password" placeholder="Mật khẩu">
                                        <div class="button-box">
                                            <button type="submit" class="btn-style cr-btn"><span>Đăng Nhập</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="lg2" class="tab-pane">
                            <div class="login-form-container">
                                <div class="login-form">
                                    <form action="{{ route('home.register') }}" method="post">
                                        @csrf
                                        <label>Họ Tên</label>
                                        <input type="text" name="name" placeholder="Họ tên">
                                        <label>Số điện thoại</label>
                                        <input type="phone" max="10" min="10" name="phone" placeholder="Số điện thoại">
                                        <label>Địa chỉ</label>
                                        <input type="text" name="address" placeholder="Địa chỉ">
                                        <label>Email (<span class="text-danger">Dùng email để đăng nhập</span>)</label>
                                        <input type="text" name="email" placeholder="Email">
                                        <label>Mật khẩu</label>
                                        <input type="password" name="password" placeholder="Mật khẩu">
                                        <label>Nhập lại mật khẩu</label>
                                        <input name="password_confirmation" placeholder="Nhập lại mật khẩu" type="Password">
                                        <div class="button-box">
                                            <button type="submit" class="btn-style cr-btn"><span>Đăng ký</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
