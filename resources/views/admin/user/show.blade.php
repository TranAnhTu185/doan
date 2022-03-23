@extends('layouts.admin')
@section('title')
Show User
@endsection
@section('css')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user') }}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Show User</h4>
                    <fieldset>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="ID">ID</label>
                                <input class="form-control text-center" value="{{ $user->id }}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <input class="form-control text-center" value="{{ $user->role }}" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input class="form-control text-center" value="{{ ucwords($user->name) }}" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input class="form-control text-center" value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                        <a href="{{ route('admin.user') }}"
                            class="btn btn-gradient-danger btn-icon-text offset-5">
                            <i class="fa fa-times-circle-o btn-icon-prepend"></i>
                            Canel
                        </a>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
