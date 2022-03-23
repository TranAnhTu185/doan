@extends('layouts.admin')
@section('title')
Thêm tài khoản
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user') }}">Tài khoản</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thêm mới</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm mới tài khoản</h4>
                    <form class="cmxform" id="signupForm" method="post"
                        action="{{ route('admin.user.store') }}">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Họ tên (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="name" type="text" placeholder="Enter Name" required>
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">Email (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="email" type="text" placeholder="Enter Email" required>
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password">Mật khẩu (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="password" type="password" placeholder="Enter Password"
                                        required>
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirm_password">Nhập lại mật khẩu (<span
                                            style="color:red">*</span>)</label>
                                    <input class="form-control" name="password_confimation" type="password"
                                        placeholder="Enter Password " required>
                                    @error('password_confimation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="role">
                                    <option value="0" selected>Staff</option>
                                    <option value="1">Manager</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary btn-icon-text offset-4">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                Thêm mới
                            </button>
                            <a href="{{ route('admin.user') }}"
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
