@extends('layouts.admin')
@section('title')
Create Customer
@endsection
@section('css')
@endsection
@section('script')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.customer') }}">Customer</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create Customer</h4>
                    <form class="cmxform" id="signupForm" method="post"
                        action="{{ route('admin.customer.store') }}">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="name" type="text" placeholder="Enter Name"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="username">Phone (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="phone" type="number" placeholder="Enter Phone"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="password">Email (<span style="color:red">*</span>)</label>
                                    <input class="form-control" name="email" type="email" placeholder="Enter Email"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input class="form-control" name="password" type="text"
                                        placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Address (<span style="color:red">*</span>)</label>
                                <input class="form-control" name="address" type="text" placeholder="Enter Address"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary btn-icon-text offset-4">
                                <i class="mdi mdi-file-check btn-icon-prepend"></i>
                                Submit
                            </button>
                            <a href="{{ route('admin.customer') }}"
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
