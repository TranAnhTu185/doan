@extends('layouts.admin')
@section('title')
Cập nhật sản phẩm
@endsection
@section('script')
{{-- <script src="{{ asset('backend/vendors/ckeditor-2/ckeditor.js') }}"></script> --}}
<script src="{{ asset('backend/vendors/ckeditor/ckeditor.js') }}"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('description');
    CKEDITOR.replace('content');

    $('#category_id').val({{ $product->category_id }});
    $('#status').val({{ $product->status }});

</script>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.product') }}">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Cập nhật sản phẩm</h4>
                    <form class="cmxform" id="signupForm" method="post"
                        action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label>Tên sản phẩm (<span style="color:red">*</span>)</label>
                                <input class="form-control" name="name" type="text" value="{{ $product->name }}"
                                    required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Số lượng (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="quantity" type="number"
                                        value="{{ $product->quantity }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Giá bán (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="price" type="number"
                                        value="{{ $product->price }}" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Giảm giá (%)</label>
                                    <input class="form-control" name="sale" type="number"
                                        value="{{ $product->sale }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả</label>
                                <textarea class="form-control" id="description"
                                    name="description">{!! $product->description !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Bài viết</label>
                                <textarea class="form-control" id="content" name="content">{!! $product->content !!}</textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Danh mục</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Trạng thái</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="1">Chọn trạng thái (Mặc định hiển thị)</option>
                                        <option value="0">Hide</option>
                                        <option value="1">Show</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ảnh (Không thao tác nếu không thay đổi)</label>
                                <div class="row mb-2 ml-1">
                                    @foreach ($product->product_image as $item)
                                    <div class="remove-image" data-role="removeImage">
                                        <img src="{{ asset('backend/images/product/'.$item->name) }}">
                                        <div class="remove"><i class="fa fa-trash"></i></div>
                                        <input type="hidden" name="remove[]" value="{{ $item->id }}" disabled>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row mt-3 ml-1">
                                    <input type="file" class="form-control" name="image[]" accept="image/*" data-role="preview-image" multiple>
                                    <div id="preview-image"></div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary btn-icon-text offset-4">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                Cập nhật
                            </button>
                            <a href="{{ route('admin.product') }}"
                                class="btn btn-gradient-danger btn-icon-text">
                                <i class="fa fa-times-circle-o btn-icon-prepend"></i>
                                Huỷ
                            </a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
