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
                                                <th>Tên sản phẩm</th>
                                                <th>Ảnh</th>
                                                <th>Số lượng</th>
                                                <th>Đơn giá</th>
                                                <th>Trạng thái</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach($products as $product)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>
                                                        @if (count($product->product_image) > 0 )
                                                            <img
                                                                src="{{ asset('backend/images/product/'.$product->product_image[0]->name) }}">
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td class="text-right">{{ number_format($product->newPrice()) }}
                                                    </td>
                                                    <td>
                                                        @if($product->status == 1)
                                                            <span
                                                                class="badge badge-pill badge-gradient-success">on</span>
                                                        @else
                                                            <span
                                                                class="badge badge-pill badge-gradient-danger">off</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="nav-item dropdown">
                                                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                                               data-toggle="dropdown">
                                                                <i class="fa fa-bars"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                                                 aria-labelledby="notificationDropdown">
                                                                <a
                                                                    href="{{ route('home.detail', [$product->id, $product->getUrl()]) }}">
                                                                    <button type="button"
                                                                            class="btn btn-info btn-rounded btn-icon">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                </a>
                                                                <a
                                                                    href="{{ route('admin.product.edit', $product->id) }}">
                                                                    <button type="button"
                                                                            class="btn btn-dark btn-rounded btn-icon">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="{{ route('admin.product.destroy',$product->id) }}"
                                                                   onclick="return confirm('Do you want to delete this product?')">
                                                                    <button type="button"
                                                                            class="btn btn-danger btn-rounded btn-icon">
                                                                        <i class="fa fa-trash-o"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="{{ route('admin.comment',$product->id) }}">
                                                                    <button type="button"
                                                                            class="btn btn-primary btn-rounded btn-icon">
                                                                        <i class="fa fa-comment"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
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
