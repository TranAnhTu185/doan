@extends('layouts.admin')
@section('title')
Cập nhật tài khoản
@endsection
@section('script')
<script type="text/javascript">
    $("#role").val({{$user->role}});
</script>
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user') }}">Tài khoản</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <form class="cmxform" id="signupForm" method="post"
                        action="{{ route('admin.user.update', $user->id) }}">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="name">Họ tên (<span style="color:red">*</span>)</label>
                                <input class="form-control" name="name" type="text" value="{{ $user->name }}"
                                    required>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="email" type="text" value="{{ $user->email }}"
                                        disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Mật khẩu (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="password" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="role" name="role">
                                    <option value="0">Staff</option>
                                    <option value="1">Manager</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary btn-icon-text offset-4">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                Cập nhật
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
