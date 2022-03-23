@extends('layouts.admin')
@section('title')
Thêm đơn hàng
@endsection
@section('css')
<style>
    .input-sm {
        height: 30px;
        padding: 5px 10px;
        font-size: 12px;
        line-height: 3;
        border-radius: 3px;
    }

    .form-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.428571429;
        color: #555555;
        vertical-align: middle;
        background-color: #ffffff;
        border: 1px solid #cccccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
        transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    }

    .list-product .quantity input {
        width: 50px !important;
        padding: 3px 4px !important
    }

    .list-product .price input {
        width: 100px !important;
        padding: 3px 4px !important
    }

    .list-product .quantity {
        width: 180px !important;
    }

    .list-product .price {
        width: 230px !important;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.bill') }}">Đơn hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Tạo đơn hàng</h3>
            @if ($payment_status != null)
            <form action="{{ route('admin.bill.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered" id="customer">
                                    <tr>
                                        <td style="width:35%">Người nhận (<span style="color:red">*</span>)</td>
                                        <td style="width:65%">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="name" placeholder="Nhập tên người nhận" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-gradient-primary"
                                                        type="button" data-toggle="modal" data-target="#exampleModal-1">Chọn</button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Số điện thoại (<span style="color:red">*</span>)</td>
                                        <td style="width:65%">
                                            <input type="number" class="form-control" name="phone"
                                                placeholder="Nhập số điện thoại" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Địa chỉ (<span style="color:red">*</span>)</td>
                                        <td style="width:65%">
                                            <input type="text" class="form-control" name="address"
                                                placeholder="Nhập địa chỉ" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="button" class="btn btn-primary btn-sm editable-submit" id="customer-1">
                                                Đặt hộ
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td style="width:35%">Phương thức thanh toán</td>
                                        <td style="width:65%">
                                            <select class="form-control" name="payment_id">
                                                @foreach ($payment_status as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Loại hoá đơn</td>
                                        <td style="width:65%">
                                            <select class="form-control" name="type_bill" id="type_bill">
                                                <option value="0">Hoá Đơn</option>
                                                <option value="1">Đặt hàng</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Trạng thái hoá đơn</td>
                                        <td style="width:65%">
                                            <select class="form-control" name="status" id="status">
                                                <option value="0">Chưa thanh toán</option>
                                                <option value="1">Đang xử lý</option>
                                                <option value="2">Đang giao hàng</option>
                                                <option value="4">Hoàn thành</option>
                                                <option value="5">Bị huỷ</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:35%">Ghi chú</td>
                                        <td style="width:65%">
                                            <input type="text" class="form-control" name="note"
                                                value="Do quản trị viên tạo">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card list-product">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Danh sách sản phẩm</h3>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>Tên sản phẩm</th>
                                            <th class="text-center">Tồn kho</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-center">Giá bán</th>
                                            <th class="text-center">Xoá</th>
                                        </thead>
                                        <tbody id="list-detail">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">
                                                    <button type="button" class="btn btn-primary btn-sm editable-submit"
                                                        data-toggle="modal" data-target="#exampleModal">Thêm sản phẩm</button>
                                                    <button type="submit" class="btn btn-primary btn-sm d-none"
                                                        id="btn-save">Lưu</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @else
                <p>Cần thêm phương thức thanh toán trước khi tạo đơn. <a href="{{ route("admin.bill.payment") }}">Click tại đây.</a></p>
            @endif
        </div>
    </div>
</div>

<!-- Modal starts -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control input-sm" id="btn-search"
                    placeholder="Enter ID, Name, Description">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-addproduct">
                <table class="table table-hover" id="ds-product">
                    @foreach($products as $item)
                    <tr class="btn-hover" onclick="selectProduct({{ $item->id }})">
                        <td width="50px">{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
<!-- Modal starts -->
<div class="modal fade" id="exampleModal-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <input type="text" class="form-control input-sm" id="btn-search-customer"
                placeholder="Enter ID, Name, Email, Phone, Address">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body table-addproduct">
            <table class="table table-hover" id="ds-customer">
                @foreach($customers as $item)
                <tr class="btn-hover" onclick="selectCustomer({{ $item->id }})">
                    <td width="50px">{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->address }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</div>
<!-- Modal Ends -->
@endsection
@section('script')
<script src="{{ asset('backend/vendors/bootstrap3-editable/js/bootstrap-editable.js') }}">
</script>
<script>
    $(function () {
        $("#customer-1").on("click", function (){
            $(this).parent().parent().parent().append('<tr>\
                            <td style="width:35%">Người đặt</td>\
                            <td style="width:65%">\
                                <input type="text" class="form-control" name="customer"\
                                    placeholder="Nhập tên người đặt">\
                            </td>\
                        </tr>');
            $(this).parent().parent().html('');
        });

        $("#type_bill").on("change", function () {
            $order = $(this).val();
            if($order == 1) {
                $("#status").html('');
                $("#status").append('<option value="0">Chưa thanh toán</option>\
                                        <option value="1">Đang xử lý</option>\
                                        <option value="2">Đang giao hàng</option>\
                                        <option value="3">Hoàn thành</option>\
                                        <option value="5">Bị huỷ</option>');
            } else {
                $("#status").html('');
                $("#status").append('<option value="0">Chưa thanh toán</option>\
                                        <option value="1">Đang xử lý</option>\
                                        <option value="2">Đang giao hàng</option>\
                                        <option value="4">Hoàn thành</option>\
                                        <option value="5">Bị huỷ</option>');
            }
        });

        $(".btn-delete").click(function () {
            let id = $(this).attr("data-id");
            $.get('/admin/bill/delete', {
                id: id
            }, function (data, status) {
                if (status == 'success') {
                    $("#bill_" + id).remove();
                }
            });
        });

        $("#btn-search").on("keyup", function () {
            let key = $(this).val();
            let ds = $("#ds-product");
            $.get('/admin/bill/search', {
                find: key
            }, function (response, status) {
                if (status == 'success') {
                    ds.html('');
                    $.each(response, function (index, e) {
                        ds.append('<tr class="btn-hover" onclick="selectProduct(' + e
                            .id + ')">\
                        <td width="50px">' + e.id + '</td>\
                        <td>' + e.name + '</td>\
                    </tr>');
                    });
                }
            });
        });

        $("#btn-search-customer").on("keyup", function () {
            let key = $(this).val();
            let ds = $("#ds-customer");
            $.get('/admin/bill/search-customer', {
                find: key
            }, function (response, status) {
                if (status == 'success') {
                    ds.html('');
                    $.each(response, function (index, e) {
                        ds.append('<tr class="btn-hover" onclick="selectCustomer(' + e
                            .id + ')">\
                        <td>' + e.name + '</td>\
                        <td>' + e.phone + '</td>\
                        <td>' + e.address + '</td>\
                    </tr>');
                    });
                }
            });
        });
    });

    function selectProduct(id) {
        $.get('/admin/bill/select', {
            id: id
        }, function (response, status) {
            if (status == 'success') {
                $("#list-detail").append('<tr id="new-product">\
                                            <input type="hidden" name="product_id[]" value="' + response.id + '">\
                                            <td>' + response.name +
                                            '</td>\
                                            <td class="text-center">' + response.quantity +
                                            '</td>\
                                            <td class="text-center quantity">\
                                                <input type="number" class="form-control mx-auto" name="quantity[]" value="1">\
                                            </td>\
                                            <td class="text-right price">\
                                                <input type="number" class="form-control float-right" name="price[]" value="' + response.price + '">\
                                            </td>\
                                            <td class="text-center">\
                                                <button type="button" onclick="removeItem(this)" class="btn btn-danger btn-sm">\
                                                    <i class="fa fa-trash"></i>\
                                                </button>\
                                            </td>\
                                        </tr>');
                $("#exampleModal").modal("hide");
                $("#btn-save").removeClass("d-none");
            }
        })
    }

    function removeItem(e) {
        let parent = $(e).parent().parent();
        parent.remove();

        let newProduct = $("#new-product");
        if (newProduct.length == 0) {
            $("#btn-save").addClass("d-none");
        }
    }


    function selectCustomer(id) {
        $.get('/admin/bill/select-customer', {id:id}, function(response, status) {
            if (status == 'success') {
                $("#customer").html('');
                $("#customer").append('<tr>\
                                    <td style="width:35%">Customer Name</td>\
                                    <td style="width:65%">\
                                        <div class="input-group">\
                                            <input type="hidden" id="customer-id" class="form-control" name="id" value="'+response.id+'">\
                                            <input type="text" class="form-control name" name="name" value="'+response.name+'">\
                                            <div class="input-group-append select-customer">\
                                                <button type="button" onclick="resetCustomer(this)" class=" btn btn-sm btn-gradient-primary"\
                                                    >Reset</button>\
                                            </div>\
                                        </div>\
                                    </td>\
                                </tr>\
                                <tr>\
                                    <td style="width:35%">Phone</td>\
                                    <td style="width:65%">\
                                        <input type="number" class="form-control phone" name="phone"\
                                        value="'+response.phone+'">\
                                    </td>\
                                </tr>\
                                <tr>\
                                    <td style="width:35%">Address</td>\
                                    <td style="width:65%">\
                                        <input type="text" class="form-control address" name="address"\
                                            value="'+response.address+'">\
                                    </td>\
                                </tr>\
                ');
                $("#exampleModal-1").modal("hide");
            }
        })
    }

    function resetCustomer(e) {
        $("#customer-id").remove();
        $(".name").val('');
        $(".phone").val('');
        $(".email").val('');
        $(".address").val('');
        $(e).remove();
        $(".select-customer").append('<button class="btn btn-sm btn-gradient-primary"\
                                                        type="button" data-toggle="modal" data-target="#exampleModal-1">Select</button>\
        ');
    }
</script>
@endsection
