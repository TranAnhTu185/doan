<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hoá đơn điện tử</title>
</head>
<body>
    <div class="content-wrapper" id="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card px-2">
                    <div class="card-body">
                        <div class="container-fluid">
                            <h3 class="text-center my-3" style="text-align: center;">ĐẶT HÀNG THÀNH CÔNG</h3>
                            <hr>
                        </div>
                        <div class="container-fluid d-flex justify-content-between">
                            <div class="col-lg-4 pl-0" style="float:left">
                                <p class="mb-0 text-right"><b>Thông tin</b></p>
                                @if ($bill->bill_customer->name != $bill->name)
                                    <p class="text-left"><b>Người đặt: </b>{{ ucwords($bill->bill_customer->name) }}</p>
                                @endif
                                <p class="text-left">Ngày tạo: {{ Date('H:i:s d-m-Y') }}</p>
                                <p class="text-left">Thanh toán: {{ $bill->bill_payment->name }}</p>
                            </div>
                            <div class="col-lg-3 pr-0" style="float:right">
                                <p class="mb-0 text-right"><b>Người nhận</b></p>
                                <p class="text-right">{{ ucwords($bill->name) }}<br> {{ $bill->phone }}<br> {{ ucwords($bill->address) }}
                                </p>
                            </div>
                        </div>
                        <div class="container-fluid mt-3 d-flex justify-content-center w-100" style="width:100%;">
                            <div class="table-responsive w-100" style="width:100%;">
                                <table class="table" style="width:100%;">
                                    <thead>
                                        <tr class="bg-dark text-white" style="background-color:black; color: white;">
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
                                        <tr class="text-right" style="text-align:right;">
                                            <td class="text-left" style="text-align:left;">{{ $i++ }}</td>
                                            <td class="text-left" style="text-align:left;">{{ $item->billdetail_product->name }}</td>
                                            <td style="text-align:center;">{{ $item->quantity }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</body>
</html>
