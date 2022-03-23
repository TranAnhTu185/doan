@extends('layouts.admin')
@section('title')
Danh mục sản phẩm
@endsection
@section('script')
<script>

    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh mục sản phẩm</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <ul class="nav">
                        <li class="w-100">
                            @foreach($categories as $category)
                                @if (count($categories) > 0)
                                    <ul class="nav row border mb-1 p-2 collapsed">
                                        <li class="nav-item col-6 pt-2" data-toggle="collapse" href="#{{ $category->id }}"
                                            aria-expanded="false" aria-controls="settings" style="cursor: context-menu;">
                                            {{ ucwords($category->name) }}
                                            <span
                                                class="badge badge-gradient-warning badge-pill ml-1">{{ $category->sort_order }}</span>
                                        </li>
                                        <li class="nav-item col-6 text-right">
                                            <a
                                                href="{{ route('admin.category.edit', $category->id) }}">
                                                <button type="button" class="btn btn-dark btn-rounded btn-icon">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('admin.category.destroy', $category->id) }}"
                                                onclick="return confirm('Do you want to delete this Category?')">
                                                <button type="button" class="btn btn-danger btn-rounded btn-icon">
                                                    <i class="fa fa-trash-o"></i>
                                                </button>
                                            </a>
                                        </li>
                                    </ul>
                                    @if($category->getParent()->count() >= 1)
                                        <div class="collapse border mb-1 ml-5 show" id="{{ $category->id }}" style="">
                                            @foreach($category->getParent() as $category)
                                                <ul class="nav row sub-menu p-2">
                                                    <li class="col-6">
                                                        <div class="nav-item pt-2">{{ ucwords($category->name) }}
                                                            <span
                                                                class="badge badge-gradient-warning badge-pill ml-1">{{ $category->sort_order }}</span>
                                                        </div>
                                                    </li>
                                                    <li class="col-6 text-right">
                                                        <a
                                                            href="{{ route('admin.category.edit', $category->id) }}">
                                                            <button type="button" class="btn btn-dark btn-rounded btn-icon">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin.category.destroy', $category->id) }}"
                                                            onclick="return confirm('Do you want to delete this Category?')">
                                                            <button type="button"
                                                                class="btn btn-danger btn-rounded btn-icon">
                                                                <i class="fa fa-trash-o"></i>
                                                            </button>
                                                        </a>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <p class="text-center">Không có danh mục.</p>
                                @endif
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body bg-dark create-cgr">
                    <h4 class="card-title">Thêm danh mục</h4>
                    <form class="cmxform" id="signupForm" method="post"
                        action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label>Tên danh mục (<span style="color:red">*</span>)</label>
                                <input class="form-control" name="name" type="text" placeholder="Nhập tên danh mục" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Danh mục cha</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="0" selected>Category Parent</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Thứ tự sắp xếp</label>
                                    <input class="form-control" name="sort_order" type="number" value="0">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary btn-icon-text offset-4 mb-1">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                Thêm mới
                            </button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
