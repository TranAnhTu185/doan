<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- Mirrored from www.urbanui.com/gleam/# by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Nov 2018 06:52:35 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet"
          href="{{ asset('backend/vendors/iconfonts/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('backend/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.base.css') }}">
    --}}
    <link rel="stylesheet" href="{{ asset('backend/vendors/css/vendor.bundle.addons.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/css/toastr.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('backend/images/favicon.png') }}" />
    @yield('css')
</head>

<body class="sidebar-icon-only">
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top flex-row not-print d-flex">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="{{ route('admin.home') }}"><img
                    src="{{ asset('backend/images/logo.svg') }}" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="{{ route('admin.home') }}"><img
                    src="{{ asset('backend/images/logo-mini.svg') }}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <span class="d-none d-md-inline">Welcome @if (Auth::check())
                    {{ ucwords(Auth::user()->name) }}
                @endif</span>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                       data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        @if ($bill > 0)
                            <span class="count-symbol bg-info"></span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                         aria-labelledby="notificationDropdown">
                        <h6 class="p-3 mb-0">Thông báo</h6>
                        @if ($bill > 0)
                            <div class="dropdown-divider"></div>
                            <a href="" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-clipboard-text"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Đơn hàng mới</h6>
                                    <p class="text-gray ellipsis mb-0">
                                        Có {{ $bill }} đơn hàng mới
                                    </p>
                                </div>
                            </a>
                        @endif
                    </div>
                </li>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                       data-toggle="dropdown">
                        <i class="fa fa-cog fa-spin"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                         aria-labelledby="notificationDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item preview-item"
                           href="{{ route('admin.logout') }}">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-danger">
                                    <i class="fa fa-power-off"></i>
                                </div>
                            </div>
                            <div
                                class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                <h6 class="preview-subject font-weight-normal mb-1">Logout</h6>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <div id="settings-trigger" class="not-print"><i class="mdi mdi-format-color-fill"></i></div>
        <div id="theme-settings" class="settings-panel">
            <i class="settings-close mdi mdi-close"></i>
            <p class="settings-heading">SIDEBAR SKINS</p>
            <div class="sidebar-bg-options selected" id="sidebar-default-theme">
                <div class="img-ss rounded-circle bg-light border mr-3"></div>Default
            </div>
            <div class="sidebar-bg-options" id="sidebar-dark-theme">
                <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
            </div>
            <p class="settings-heading mt-2">HEADER SKINS</p>
            <div class="color-tiles mx-0 px-4">
                <div class="tiles primary"></div>
                <div class="tiles success"></div>
                <div class="tiles warning"></div>
                <div class="tiles danger"></div>
                <div class="tiles info"></div>
                <div class="tiles dark"></div>
                <div class="tiles default light"></div>
            </div>
        </div>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas not-print" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.home') }}">
                        <i class="fa fa-dashboard menu-icon"></i>
                        <span class="menu-title">Bảng Điều Khiển</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#product" aria-expanded="false"
                       aria-controls="product">
                        <i class="fa fa-folder-open menu-icon"></i>
                        <span class="menu-title">Quản Lý Sản Phẩm</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="product">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.product') }}">
                                    Sản Phẩm
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#bill" aria-expanded="false"
                       aria-controls="bill">
                        <i class="fa fa-cart-arrow-down menu-icon"></i>
                        <span class="menu-title">Quản Lý Đơn Hàng</span></span>
                        @if ($bill > 0)
                            <span class="badge badge-gradient-primary badge-pill">{{ $bill }}</span>
                        @else
                            <i class="menu-arrow"></i>
                        @endif
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#settings" aria-expanded="false"
                       aria-controls="settings">
                        <i class="fa fa-cogs menu-icon fa-spin"></i>
                        <span class="menu-title">Cài Đặt</span>
                        <i class="menu-arrow"></i>
                   </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
        @yield('content')
        <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            Copyright © @php echo date('Y') @endphp
                            <a href="https://www.facebook.com/Shopbook.vn" target="_blank">ShopBook</a>. All rights reserved.
                        </span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                            with <i class="mdi mdi-heart text-danger"></i></span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('backend/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('backend/vendors/js/vendor.bundle.addons.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('backend/js/off-canvas.js') }}"></script>
<script src="{{ asset('backend/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('backend/js/misc.js') }}"></script>
<script src="{{ asset('backend/js/settings.js') }}"></script>
<script src="{{ asset('backend/js/todolist.js') }}"></script>
<!-- endinject -->
<script src="{{ asset('backend/js/script.js') }}"></script>
<script src="{{ asset('backend/js/toastr.min.js') }}"></script>
<script src="{{ asset('backend/js/data-table.js') }}"></script>
@yield('script')
@if (Session::has('success'))
    <script>
        $(function(){
            toastr.success( '{{ Session::get('success') }}', {"showButton":true});
        })
    </script>
@endif
@if (Session::has('error'))
    <script>
        $(function(){
            toastr.error( '{{ Session::get('error') }}', {"showButton":true});
        })
    </script>
@endif
</body>
<!-- Mirrored from www.urbanui.com/gleam/# by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 29 Nov 2018 06:53:08 GMT -->

</html>
