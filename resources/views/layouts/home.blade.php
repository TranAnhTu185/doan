<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ShopBook</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/img/logo/images.png') }}">

    <!-- all css here -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    @yield('css')
    <script src="{{ asset('frontend/js/vendor/modernizr-2.8.3.min.js') }}"
            type="text/javascript"></script>
</head>

<body>
<div class="wrapper">
    <!-- header start -->
    <header>
        <div class="header-area transparent-bar header-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 d-none d-sm-block d-md-block">
                        <div class="language-currency">
                            <div class="menu-icon">
                                <button><i class="ion-android-menu"></i></button>
                            </div>
                        </div>
                        <div class="menu-icon menu-icon-none">
                            <button><i class="ion-android-menu"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-5">
                        <div class="logo-menu-wrapper text-center">
                                <div class="logo pr-100">
                                    <a href="{{ route('home.index') }}"><img
                                            src="{{ asset('backend/images/logo/1648230123-images.png') }}"
                                            alt=""></a>
                                </div>
                                <div class="sticky-logo pr-100">
                                    <a href="{{ route('home.index') }}"><img
                                            src="{{ asset('backend/images/logo/1648230123-images.png') }}"
                                            alt="" style="width:75px;"></a>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-7">
                        <div class="header-site-icon">
                            <div class="header-search same-style">
                                <button class="sidebar-trigger-search">
                                    <span class="ti-search"></span>
                                </button>
                            </div>
                            @if(Auth::guard('customer')->check())
                                <div class="btn-group">
                                    <div class="btn btn-outline">{{ ucwords(Auth::guard('customer')->user()->name) }}</div>
                                    <button type="button" class="btn btn-outline dropdown-toggle dropdown-toggle-split"
                                            id="dropdownMenuSplitButton6" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton6"
                                         x-placement="bottom-start"
                                         style="position: absolute; transform: translate3d(148px, 44px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <h6 class="dropdown-header">C??i ?????t</h6>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('home.logout') }}">????ng xu???t</a>
                                    </div>
                                </div>
                            @else
                                <div class="header-login same-style">
                                    <a href="{{ route('home.loginpage') }}">
                                        <i class="ti-user"></i>
                                    </a>
                                </div>
                            @endif
                            <div class="header-cart same-style">
                                <button class="sidebar-trigger">
                                    <i class="ti-shopping-cart"></i>
                                    <span class="count-style" data-cart="count"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area meanmenu2-style col-12">
                        <div class="mobile-menu">
                            <nav id="mobile-menu-active">
                                <ul class="menu-overflow">
                                    <li><a href="{{ route('home.index') }}">home</a></li>
                                    @foreach($categories as $category)
                                        @if($category->getParent()->count() > 0)
                                            <li class="cr-dropdown"><a href="">{{ $category->name }}<i
                                                        class="ion-ios-arrow-down float-right"></i></a>
                                                <ul>
                                                    @foreach($category->getParent() as $item)
                                                        <li><a
                                                                href="{{ route("home.list", [ $item->id, $item->getUrl()]) }}">{{ $item->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a
                                                    href="{{ route("home.list", [ $category->id, $category->getUrl()]) }}">{{ $category->name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- menu-style start -->
    <div class="sidebarmenu-wrapper">
        <div class="menu-close">
            <button><i class="ion-android-close"></i></button>
        </div>
        <div class="sidebarmenu-style">
            <nav class="menu">
                <ul>
                    <li><a href="{{ route('home.index') }}">home</a></li>
                    @foreach($categories as $category)
                        @if($category->getParent()->count() > 0)
                            <li class="cr-dropdown"><a href="">{{ $category->name }}<i
                                        class="ion-ios-arrow-down float-right"></i></a>
                                <ul>
                                    @foreach($category->getParent() as $item)
                                        <li><a
                                                href="{{ route("home.list", [ $item->id, $item->getUrl()]) }}">{{ $item->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a
                                    href="{{ route("home.list", [ $category->id, $category->getUrl()]) }}">{{ $category->name }}</a>
                            </li>
                        @endif
                    @endforeach
                    <li>
                        <a href="{{ route('home.contact') }}">Li??n h???</a>
                    </li>
                </ul>
            </nav>
        </div>
            <div class="follow-area mt-3">
                <h4 class="newsletter-title">Follow Us</h4>
                <div class="follow-icon">
                    <ul>
                        <li class="facebook">
                            <a href="https://www.facebook.com/Shopbook.vn">
                                <i class="ion-social-facebook"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
    <!-- sidebar-cart start -->
    <div class="sidebar-cart onepage-sidebar-area">
        <div class="wrap-sidebar">
            <div class="sidebar-cart-all">
                <div class="sidebar-cart-icon">
                    <button class="op-sidebar-close"><span class="ti-close"></span></button>
                </div>
                <div class="cart-content">
                    <h3>Gi??? H??ng</h3>
                    <ul>
                        <div data-cart="products"></div>
                        <li class="single-product-cart">
                            <div class="cart-total">
                                <h4>Total : <span data-cart="total"></span></h4>
                            </div>
                        </li>
                    </ul>
                    <div class="cart-checkout-btn">
                        <a class="cr-btn btn-style cart-btn-style"
                           href="{{ route('home.cart') }}"><span>Xem gi??? h??ng</span></a>
                        <a class="no-mrg cr-btn btn-style cart-btn-style btn-checkout"
                           href="{{ route('home.checkout') }}"><span>Thanh to??n</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-search start -->
    <div class="header-height"></div>
    @yield('content')
    <footer class="theme-bg footer-padding">
        <div class="container-fluid">
            <div class="footer-top pt-85 pb-25">
                    <div class="row">
                        <div class="col-3">
                            <div class="footer-widget mb-30">
                                <div class="footer-widget-title">
                                    <img src="{{ asset('backend/images/logo/1648230123-images.png') }}" style="width:75px" alt="">
                                </div>
                                <div class="food-info-wrapper">
                                        <div class="food-address">
                                            <div class="food-info-content">
                                                <p>ShopBook chuy??n ph??n ph???i cung c???p s??ch</p>
                                            </div>
                                        </div>
                                        <div class="single-twitter">
                                            <div class="twitter-icon">
                                                <i class="ion-social-facebook-outline"></i>
                                            </div>
                                            <div class="twitter-content">
                                                <p><a href="https://www.facebook.com/Shopbook.vn">Page Shop</a></p>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-3">
                            <div class="footer-widget mb-30">
                                <div class="footer-widget-title">
                                    <h3>t??i kho???n</h3>
                                </div>
                                <div class="food-widget-content">
                                    <ul class="quick-link">
                                        <li><a href="{{ route('home.login') }}">????ng nh???p</a></li>
                                        <li><a href="{{ route('home.login') }}">????ng k??</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-4">
                            <div class="footer-widget mb-30">
                                <div class="footer-widget-title">
                                    <h3>Li??n h???</h3>
                                </div>
                                <div class="food-info-wrapper">
                                    <div class="food-address">
                                        <div class="food-info-icon">
                                            <i class="ion-ios-home-outline"></i>
                                        </div>
                                        <div class="food-info-content">
                                            <p>H?? N???i</p>
                                        </div>
                                    </div>
                                    <div class="food-address">
                                        <div class="food-info-icon">
                                            <i class="ion-ios-telephone-outline"></i>
                                        </div>
                                        <div class="food-info-content">
                                            <p>0977902031</p>
                                        </div>
                                    </div>
                                    <div class="food-address">
                                        <div class="food-info-icon">
                                            <i class="ti-mobile"></i>
                                        </div>
                                        <div class="food-info-content">
                                            <p>0123456789</p>
                                        </div>
                                    </div>
                                    <div class="food-address">
                                        <div class="food-info-icon">
                                            <i class="ion-ios-email-outline"></i>
                                        </div>
                                        <div class="food-info-content">
                                            <p><a href="#">shopbook@gmail.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="footer-bottom border-top-1 ptb-15">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="copyright-payment">
                            <div class="copyright">
                                <p>Copyright ?? @php echo date('Y') @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header modal-close">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ion-android-close" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="qwick-view-left">
                        <div class="quick-view-learg-img">
                            <div class="quick-view-tab-content tab-content">
                                <div class="tab-pane active show fade" id="image" role="tabpanel">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="qwick-view-right">
                        <div class="qwick-view-content">
                            <h3 id="name"></h3>
                            <div class="price">
                                <span class="new" id="newPrice"></span>
                                <span class="old" id="price"></span>
                            </div>
                            <div class="rating-number">
                                <div class="quick-view-rating">
                                    <i class="ion-ios-star red-star"></i>
                                    <i class="ion-ios-star red-star"></i>
                                    <i class="ion-ios-star red-star"></i>
                                    <i class="ion-ios-star red-star"></i>
                                    <i class="ion-ios-star red-star"></i>
                                </div>
                            </div>
                            <p id="description"></p>
                            <form onsubmit="return quickView(this)" method="post" id="form-addCart">
                                <div class="quickview-plus-minus">
                                    <div class="cart-plus-minus">
                                        <input type="text" value="1" name="quantity" class="cart-plus-minus-box">
                                    </div>
                                    <div class="quickview-btn-cart">
                                        <button type="submit" class="btn-style cr-btn" href="#">Th??m v??o gi???
                                            h??ng</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
</div>
<!-- all js here -->
<script src="{{ asset('frontend/js/vendor/jquery-3.5.1.js') }}" type="text/javascript">
</script>
<script src="{{ asset('frontend/js/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/ajax-mail.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/plugins.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/main.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/cart.js') }}" type="text/javascript"></script>
@yield('script')
</body>

</html>
