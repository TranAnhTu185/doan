@extends('layouts.admin')
@section('title', 'Hoá đơn điện tử')
@section('content')
<div class="content-wrapper" id="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card px-2">
                <div class="card-body">
                    <div class="container-fluid">
                        <h3 class="my-3">Hoá đơn #{{ $bill->id }}</h3>
                        <hr>
                    </div>
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-4 pl-0">
                            <p class="mt-3 mb-0">Nhân viên: <b>@if (Auth::check()) {{ Auth::user()->name }} @endif</b></p>
                            <p class="mb-0">Ngày tạo: {{ Date('H:i:s d-m-Y') }}</p>
                            <p class="mb-0">Ngày đặt hàng: {{ $bill->created }}</p>
                            <p class="mb-0">Thanh toán: {{ $bill->bill_payment->name }}</p>
                        </div>
                        <div class="col-lg-3 pr-0">
                            @if ($bill->bill_customer->name != $bill->name)
                                <p class="mt-3 mb-0 text-right"><b>Người đặt: </b>{{ ucwords($bill->bill_customer->name) }}</p>
                            @endif
                            <p class="mb-0 text-right"><b>Người nhận</b></p>
                            <p class="text-right">{{ ucwords($bill->name) }}<br> {{ $bill->phone }}<br> {{ ucwords($bill->address) }}
                            </p>
                        </div>
                    </div>
                    <div class="container-fluid mt-3 d-flex justify-content-center w-100">
                        <div class="table-responsive w-100">
                            <table class="table">
                                <thead>
                                    <tr class="bg-dark text-white">
                                        <th>#</th>
                                        <th>Sản phẩm</th>
                                        <th class="text-right">Số lượng</th>
                                        <th class="text-right">Đơn giá</th>
                                        <th class="text-right">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($bill->bill_billdetail as $item)
                                    <tr class="text-right">
                                        <td class="text-left">{{ $i++ }}</td>
                                        <td class="text-left">{{ $item->billdetail_product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price) }}</td>
                                        <td>{{ number_format($item->quantity * $item->price) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid mt-5 w-100">
                        <h4 class="text-right mb-5">Tổng hoá đơn: {{ number_format($total) }}</h4>
                        <hr>
                    </div>
                    <div class="container-fluid w-100">
                        <button onclick="printBill('content')" class="btn btn-primary float-right mt-4 ml-2 not-print"><i
                                class="mdi mdi-printer mr-1"></i>In</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
@endsection
@section('script')
<script>
    function printBill(content) {
        $(".not-print").hide();
        var backup = document.body.innerHTML;
        var divcontent = document.getElementById(content).innerHTML;
        document.body.innerHTML = divcontent;
        window.print();
        document.body.innerHTML = backup;
        $(".not-print").show();
    }
</script>
@endsection
