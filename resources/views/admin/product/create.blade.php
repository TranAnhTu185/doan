@extends('layouts.admin')
@section('title')
Thêm mới sản phẩm
@endsection
@section('css')
@endsection
@section('script')
<script src="{{ asset('backend/vendors/ckeditor/ckeditor.js') }}"></script>
{{-- <script src="{{ asset('backend/vendors/ckeditor-2/ckeditor.js') }}"></script> --}}
<script>
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
</script>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.product') }}">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm sản phẩm</h4>
                    @if ($categories != null)
                    <form class="cmxform" id="signupForm" method="post"
                        action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label>Tên sản phẩm (<span style="color:red">*</span>)</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter Name" required>
                                @error('name')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Số lượng</label>
                                    <input class="form-control" name="quantity" type="number"
                                        placeholder="Enter Quantity" required>
                                        @error('quantity')
                                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Giá bán (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="price" type="number" placeholder="Enter Price"
                                        required>
                                        @error('price')
                                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                        @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Giảm giá (%)</label>
                                    <input class="form-control" name="sale" value="0" type="number" placeholder="Enter Sale">
                                    @error('sale')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea id="editor1" class="form-control" cols="80" rows="10"
                                    name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Bài viết</label>
                                <textarea id="editor2" class="form-control" cols="80" rows="10"
                                    name="content"></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label>Danh mục</label>
                                    <select class="form-control" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Trạng thái</label>
                                    <select class="form-control" name="status">
                                        <option value="1">Chọn trạng thái (Mặc định hiển thị)</option>
                                        <option value="0">off</option>
                                        <option value="1">on</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="file" class="form-control" name="image[]" data-role="preview-image"
                                    multiple>
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div id="preview-image"></div>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary btn-icon-text offset-4">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                Thêm mới
                            </button>
                            <a href="{{ route('admin.product') }}"
                                class="btn btn-gradient-danger btn-icon-text">
                                <i class="fa fa-times-circle-o btn-icon-prepend"></i>
                                Huỷ
                            </a>
                        </fieldset>
                    </form>
                    @else
                    <p class="text-center"><a href="{{ route('admin.category') }}">Click tại đây</a> để tạo danh mục trước khi tạo sản phẩm</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
