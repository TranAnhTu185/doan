@extends('layouts.admin')
@section('title')
Edit Category
@endsection
@section('script')
<script src="{{ asset('backend/vendors/ckeditor-2/ckeditor.js') }}"></script>
<script>

    $("#parent_id").val({{ $category->parent_id }});
</script>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.category') }}">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    <form class="cmxform" id="signupForm" method="post"
                        action="{{ route('admin.category.update', $category->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label>Name (<span style="color:red">*</span>)</label>
                                <input class="form-control" name="name" type="text" value="{{ $category->name }}"
                                    required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Sort Order</label>
                                    <input class="form-control" name="sort_order" type="number"
                                        value="{{ $category->sort_order }}">
                                        @error('sort_order')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                @if($category->parent_id != 0)
                                    <div class="form-group col-md-6">
                                        <label>Category parent</label>
                                        <select class="form-control" name="parent_id" id="parent_id">
                                            <option value="0">Category Parent</option>
                                            @foreach($parent_id as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-gradient-primary btn-icon-text offset-4">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                Submit
                            </button>
                            <a href="{{ route('admin.category') }}"
                                class="btn btn-gradient-danger btn-icon-text">
                                <i class="fa fa-times-circle-o btn-icon-prepend"></i>
                                Canel
                            </a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
