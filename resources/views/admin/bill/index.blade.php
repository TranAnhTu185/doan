@extends('layouts.admin')
@section('title')
Đơn hàng
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
            </ol>
        </nav>
        <a href="{{ route('admin.bill.create') }}" class="mr-4">
            <button type="button" class="btn btn-primary btn-rounded btn-icon float-right">
                <i class="fa fa-plus"></i>
            </button>
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <div id="order-listing_wrapper"
                            class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="order-listing" class="table dataTable no-footer" role="grid"
                                        aria-describedby="order-listing_info">
                                        <thead>
                                            <tr role="row">
                                                <th>#</th>
                                                <th>Tên khách hàng</th>
                                                <th>Ngày tạo</th>
                                                <th class="text-center">Phương thức thanh toán</th>
                                                <th class="text-center">Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1 @endphp
                                                @foreach($bills as $bill)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td><a href="{{ route("admin.customer.show", $bill->customer_id) }}">{{ ucwords($bill->bill_customer->name) }}</a></td>
                                                        <td>{{ $bill->created }}</td>
                                                        <td class="text-center">{{ $bill->bill_payment->name }}</td>
                                                        <td class="text-center">
                                                            @if ($bill->status == 0)
                                                            Chưa thanh toán
                                                            @elseif($bill->status == 1)
                                                            Đang xử lý
                                                            @elseif($bill->status == 2)
                                                            Đang giao hàng
                                                            @elseif($bill->status == 3)
                                                            Hoàn thành
                                                            @elseif($bill->status == 4)
                                                            Hoàn thành
                                                            @elseif($bill->status == 5)
                                                            Bị huỷ
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="{{ route('admin.bill.show', $bill->id) }}">
                                                                <button type="button"
                                                                    class="btn btn-info btn-rounded btn-icon">
                                                                    <i class="fa fa-eye"></i>
                                                                </button>
                                                            </a>
                                                            @if ($bill->status != 3 && $bill->status != 4 && $bill->status != 5)
                                                                <a
                                                                    href="{{ route('admin.bill.edit', $bill->id) }}">
                                                                    <button type="button"
                                                                        class="btn btn-dark btn-rounded btn-icon">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                            @if ($bill->status == 0)
                                                                <a
                                                                    href="{{ route('admin.bill.destroy', $bill->id) }}" onclick="return confirm('Do you want to delete this bill?')">
                                                                    <button type="button"
                                                                        class="btn btn-danger btn-rounded btn-icon">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
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
