@extends('layouts.admin')
@section('title')
Cập nhật đơn hàng
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
                <li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Chi tiết đơn hàng #{{ $bill->id }}</h3>
            <div class="row">
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td style="width:35%">Người nhận</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" id="customer_name" data-name="name" data-type="text"
                                            data-pk="{id: {{ $bill->id }}, db: 'bills'}"
                                            data-title="Enter Name" data-placement="Required">{{ $bill->name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Số điện thoại</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-click" data-name="phone" data-type="number"
                                            data-pk="{id: {{ $bill->id }}, db: 'bills'}"
                                            data-title="Enter Phone" data-placement="Required">{{ $bill->phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Địa chỉ</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-pre-wrapped editable-click" id="address" data-name="address" data-type="textarea"
                                            data-pk="{id: {{ $bill->id }}, db: 'bills'}"
                                            data-title="Enter Address" data-row="10">{{ $bill->address }}</a>
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
                                        <a href="#" class="select-editable" id="payments" data-type="select" data-pk="{id: {{ $bill->id }}, db: 'bills'}" data-name="payment_id" data-source="[@foreach($payment_status as $item) {value: {{ $item->id }}, text: '{{ $item->name }}'}, @endforeach]" data-title="Select Payments"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Trạng thái đơn hàng</td>
                                    <td style="width:65%">
                                        <a href="#" class="select-editable" id="status" data-type="select" data-pk="{id: {{ $bill->id }}, db: 'bills'}" data-name="status" data-source="[{value: 0, text: 'Chưa thanh toán'}, {value: 1, text: 'Đang xử lý'}, {value: 2, text: 'Đang giao hàng'}, {value: 3, text: 'Hoàn thành đặt hàng'}, {value: 4, text: 'Hoàn thành hoá đơn'}, {value: 5, text: 'Bị huỷ'}]" data-title="Select Status"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Ngày tạo</td>
                                    <td style="width:65%">
                                        {{ $bill->created }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:35%">Ghi chú</td>
                                    <td style="width:65%">
                                        <a href="#" class="editable editable-pre-wrapped editable-click" data-name="note" data-type="textarea"
                                            data-pk="{id: {{ $bill->id }}, db: 'bills'}"
                                            data-title="Enter Note" data-placement="Required">{{ $bill->note }}</a>
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
                            <form action="{{ route('admin.bill.add') }}" method="post">
                                @csrf
                                <input type="hidden" name="bill_id" value="{{ $bill->id}}">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <th>Tên sản phẩm</th>
                                        <th class="text-center">Tồn kho</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Giá bán</th>
                                        <th class="text-center">Xoá</th>
                                    </thead>
                                    <tbody id="list-detail">
                                        @foreach($bill->bill_billdetail as $item)
                                            <tr id="bill_{{ $item->id }}">
                                                <td>
                                                    {{ $item->billdetail_product->name }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $item->billdetail_product->quantity }}
                                                </td>
                                                <td class="text-center quantity">
                                                    <a href="#" class="editable editable-click" data-value="{{ $item->quantity }}" data-name="quantity" data-type="number"
                                                        data-pk="{id: {{ $item->id }}, db: 'bill_detail'}"
                                                        data-title="Enter Quantity">{{ $item->quantity }}</a>
                                                </td>
                                                <td class="text-right price">
                                                    <a href="#" class="editable editable-click" data-value="{{ $item->price }}" data-name="price" data-type="number"
                                                        data-pk="{id: {{ $item->id }}, db: 'bill_detail'}"
                                                        data-title="Enter Price">{{ number_format($item->price) }}</a>

                                                </td>
                                                <td class="text-center">
                                                    <button type="button" data-id="{{ $item->id }}" class="btn-delete btn btn-danger btn-sm editable-submit">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
                                                <button type="button" class="btn btn-primary btn-sm editable-submit" data-toggle="modal" data-target="#exampleModal">Thêm sản phẩm</button>
                                                <button type="submit" class="btn btn-primary btn-sm d-none" id="btn-save">Save</button>
                                            </td>
                                            <td class="text-right" colspan="2">
                                                Total: <span id="total">{{ number_format($total) }}</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal starts -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control input-sm" id="btn-search" placeholder="Enter ID, Name, Description">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-addproduct">
                <table class="table table-hover" id="ds-product">
                    @foreach ($product as $item)
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
@endsection
@section('script')
<script src="{{ asset('backend/vendors/bootstrap3-editable/js/bootstrap-editable.js') }}"></script>
<script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });

        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.url = '{{ route('admin.bill.update', $bill->id) }}';

        $('.editable').editable(
            {
                success: function(response, newValue){
                    if (response.error){
                        toastr.error(response.error, 'Error', {"showButton":true});
                    }
                    $("#total").html(formatNumber(response.total));
                }
            }
        );

        $('#payments').editable({
            showbuttons: false,
            value: {{ $bill->bill_payment->id }}
        });

        $('#status').editable({
            showbuttons: false,
            value: {{ $bill->status }}
        });

        $(".btn-delete").click(function(){
            let id = $(this).attr("data-id");
            $.get('/admin/bill/delete', { id: id}, function(data, status){
                if (status == 'success'){
                    $("#bill_"+id).remove();
                }
            });
        });

        $("#btn-search").on("keyup", function(){
            let key = $(this).val();
            let ds = $("#ds-product");
            $.get('/admin/bill/search', {find:key}, function(response, status){
                if (status == 'success'){
                    ds.html('');
                    $.each(response, function(index, e){
                        ds.append('<tr class="btn-hover" onclick="selectProduct(' + e.id + ')">\
                        <td width="50px">' +e.id+ '</td>\
                        <td>'+e.name+'</td>\
                    </tr>');
                    });
                }
            });
        });


    });

    function selectProduct(id){
        $.get('/admin/bill/select', {id:id}, function(response, status){
            if (status == 'success'){
                $("#list-detail").append('<tr id="new-product">\
                                            <input type="hidden" name="product_id[]" value="'+response.id+'">\
                                            <td>'+response.name+'</td>\
                                            <td class="text-center">'+response.quantity+'</td>\
                                            <td class="text-center quantity">\
                                                <input type="number" class="form-control mx-auto" name="quantity[]" value="1">\
                                            </td>\
                                            <td class="text-right price">\
                                                <input type="number" class="form-control float-right" name="price[]" value="'+response.price+'">\
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
</script>
@endsection
