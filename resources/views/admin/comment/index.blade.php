@extends('layouts.admin')
@section('title')
    Sản phẩm
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                </ol>
            </nav>
            <a href="{{ route('admin.product.create') }}" class="mr-4">
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
                                                <th>Tên Khách Hàng</th>
                                                <th>Nội dung comment</th>
                                                <th>Ngày Tạo</th>
                                                <th>Thao tác</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach($comments as $comment)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>
                                                        {{ $comment->customer->name }}
                                                    </td>
                                                    <td>{{ $comment->content }}</td>
                                                    <td>{{ $comment->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.comment.delete',$comment->id) }}"
                                                           onclick="return confirm('bạn có muốn xóa comment này không?')">
                                                            <button type="button"
                                                                    class="btn btn-danger btn-rounded btn-icon">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </a>
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
