@extends('layouts.admin')
@section('title')
Bảng điều khiển
@endsection
@section('css')
@endsection
@section('script')
<!-- Custom js for this page-->
<script src="{{asset('backend/js/dashboard.js')}}"></script>
<!-- End custom js for this page-->
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Bảng điều khiển</a></li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-success border-0 text-white p-3">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <i class="fa fa-shopping-cart size-30px"></i>
                        <div class="ml-4">
                            <h2 class="mb-2">{{ $amount_p }}</h2>
                            <h4 class="mb-0">Sản phẩm</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-danger border-0 text-white p-3">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <i class="fa fa-users size-30px"></i>
                        <div class="ml-4">
                            <h2 class="mb-2">{{ $amount_u }}</h2>
                            <h4 class="mb-0">Thành viên</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-info border-0 text-white p-3">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <i class="fa fa-user-o size-30px"></i>
                        <div class="ml-4">
                            <h2 class="mb-2">{{ $amount_c }}</h2>
                            <h4 class="mb-0">Khách hàng</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-gradient-primary border-0 text-white p-3">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <i class="fa fa-money size-30px"></i>
                        <div class="ml-4">
                            <h2 class="mb-2">{{ $amount_b }}</h2>
                            <h4 class="mb-0">Đơn hàng</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- content-wrapper ends -->
@endsection
