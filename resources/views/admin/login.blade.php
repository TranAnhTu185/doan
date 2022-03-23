<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from brandio.io/envato/iofrm/html/register8.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Dec 2018 08:32:18 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iofrm</title>
    <link rel="icon" href="{{ asset('backend/images/favicon.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/iofrm-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/css/iofrm-theme8.css')}}">
</head>
<body>
<div class="form-body">
    <div class="website-logo">
            <a href="#">
            <div class="logo">
                <img class="logo-size" src="{{asset('backend/images/logo.svg')}}" alt="">
            </div>
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <h3>Xin Chào!</h3>
                <p>Đăng nhập bằng tài khoản quản trị viên.</p>
                <img src="{{asset('backend/images/graphic4.svg')}}" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <div class="website-logo-inside">
                        <a href="#">
                            <div class="logo">
                                <img class="logo-size" src="{{asset('backend/images/logo-light.svg')}}" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="page-links">
                        <a>Login</a>
                    </div>
                    <form action="{{Route('admin.login')}}" method="post">
                        @csrf
                        <input class="form-control" type="email" name="email" placeholder="E-mail" required>
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                        @if(session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('backend/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/js/popper.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/main.js')}}"></script>
</body>

<!-- Mirrored from brandio.io/envato/iofrm/html/register8.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Dec 2018 08:32:18 GMT -->
</html>
