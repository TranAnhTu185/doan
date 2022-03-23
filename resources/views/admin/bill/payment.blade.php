@extends('layouts.admin')
@section('title')
Trạng thái thanh toán
@endsection
@section('css')
    <style>
        .modal .modal-dialog .modal-content .modal-body {
            padding: 0 20px;
        }

        .modal {
            top: -70px;
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">Phương thức thanh toán</li>
            </ol>
        </nav>
        <button type="button" class="mr-4 btn btn-primary btn-rounded btn-icon float-right" data-toggle="modal"
        data-target="#add" data-whatever="@getbootstrap">
            <i class="fa fa-plus"></i>
        </button>
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
                                                <th>Tên</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1 @endphp
                                                @foreach($payments as $item)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ ucwords($item->name) }}</td>
                                                        <td>
                                                            <button type="button"
                                                                class="btn btn-dark btn-rounded btn-icon" onclick="btnEdit({{ $item->id }})">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button"
                                                                class="btn btn-danger btn-rounded btn-icon" onclick="btnDelete(this, {{ $item->id }})">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
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
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.bill.add-payment') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Thêm phương thức thanh toán</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên phương thức:</label>
                        <input type="text" class="form-control" name="name" required>
                        <label for="recipient-name" class="col-form-label">Nội dung:</label>
                        <textarea class="form-control" id="note" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success add-status">Thêm mới</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Huỷ</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.bill.update-payment') }}" method="POST">
            @csrf
            <input type="hidden" class="form-control" id="id" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Cập nhật trạng thái thanh toán</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tên trạng thái:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <label for="recipient-name" class="col-form-label">Nội dung:</label>
                        <textarea class="form-control" id="note1" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success add-status">Cập nhật</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Huỷ</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('backend/vendors/ckeditor-3/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('note');
    CKEDITOR.replace('note1');

    function btnEdit(id) {
        $.get('/admin/bill/edit-payment/'+id, function(data){
            $("#edit").modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
            CKEDITOR.instances.note.setData(data.note);
        })
    }

    function btnDelete(e, id) {
        let parent = $(e).parent().parent();
        $.get('/admin/bill/delete-payment/'+id, function(){
            parent.remove();
            toastr.success('Xoá trạng thái thành công.', {"showButton":true});
        })
    }
</script>
@endsection
